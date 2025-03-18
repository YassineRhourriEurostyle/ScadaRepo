<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Sites;
use App\Entity\ConfigMachines; 
use App\Entity\ConfigTools; 
use App\Entity\ConfigToolVersions;
use App\Entity\SettingsStandardFiles;
use App\Entity\SettingsStandardTemplate; 
use App\Entity\SettingsStandard;
use App\Repository\SettingsStandardFilesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/settingsstandardfiles")
 */
class SettingsStandardFilesController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="settingsstandardfiles_index")
     */
    public function index(Request $request,EntityManagerInterface $em)
    {
        // Get filter parameters from request
        $siteId = $request->query->get('site');
        $machineId = $request->query->get('machine');
        $toolId = $request->query->get('tool');

        $sites = $em->getRepository(Sites::class)->findAll();
        $machines = $em->getRepository(ConfigMachines::class)->findAll();
        $tools = $em->getRepository(ConfigTools::class)->findAll();

        // Convert empty string values to null
        $siteId = !empty($siteId) ? (int) $siteId : null;
        $machineId = !empty($machineId) ? (int) $machineId : null;
        $toolId = !empty($toolId) ? (int) $toolId : null;
        $settingsFiles = $em->getRepository(SettingsStandardFiles::class)->findFilteredFiles($siteId,$machineId,$toolId);
        $groupedFiles = [];
        
        foreach ($settingsFiles as $file) {
            // Fetch Site by its ID
            $site = $em->getRepository(Sites::class)->findOneBy(['idsites' => $file->getIdsite()]);
            //$file->siteName = $site ? $site->getSiteref() : 'Unknown Site';
            $siteName = $site ? $site->getSiteref() : 'Unknown Site';

            // Fetch Machine by its ID
            $machine = $em->getRepository(ConfigMachines::class)->findOneBy(['idcfgmachine' => $file->getIdmachine()]);
            $file->machineName = $machine ? $machine->getMacreference() : 'Unknown Machine';
    
            // Fetch Tool by its ID
            $tool = $em->getRepository(ConfigTools::class)->findOneBy(['idcfgtool' => $file->getIdtool()]);
            $file->toolName = $tool ? $tool->getToolreference() : 'Unknown Tool';
    
            // Fetch Tool Version by its ID
            $toolVersion = $em->getRepository(ConfigToolVersions::class)->findOneBy(['idcfgtoolversion' => $file->getIdtoolversion()]);
            $file->toolVersionName = $toolVersion ? $toolVersion->getToolversiontext() : 'Unknown Version';

            $file->siteName = $siteName;

            $groupedFiles[$siteName][] = $file;

        }
        //check group user if he is admin to allow him hide files to other users
        $isInGroup1 = UserLog::isUserInGroup($this->session, $em, 1);
        return $this->render('settings_standard_files/index.html.twig', [
            'settingsFiles' => $settingsFiles,
            'groupedFiles' => $groupedFiles,
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'selectedSite' => $siteId,
            'selectedMachine' => $machineId,
            'selectedTool' => $toolId,
            'isInGroup1'=>$isInGroup1
        ]);
    }
    /**
     * @Route("/new", name="settingsstandardfiles_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        // Fetch available sites for dropdown
        $sites = $em->getRepository(Sites::class)->findAll();

        if ($request->isMethod('POST')) {
            // Get form data from request
            $siteId = $request->request->get('site');
            $machineName = $request->request->get('machine');
            $toolName = $request->request->get('tool');
            $toolVersionName = $request->request->get('toolVersion');

            // Handle image upload (optional)
            $imageFile = $request->files->get('image'); // Get the uploaded image
            $imageFilename = null;

            // Validate input
            if (!$siteId || !$machineName || !$toolName || !$toolVersionName) {
                $this->addFlash('error', 'All fields are required.');
                return $this->redirectToRoute('settingsstandardfiles_new');
            }

            // Find or create the machine
            $machine = $em->getRepository(ConfigMachines::class)->findOneBy(['macreference' => $machineName]) 
                        ?? (new ConfigMachines())
                        ->setMacreference($machineName)
                        ->setIdsite($siteId) // Set the site ID
                        ->setMacdatecreation((new \DateTime())->format('YmdHis')); // Set the current timestamp for date creation

            // Find or create the tool
            $tool = $em->getRepository(ConfigTools::class)->findOneBy(['toolreference' => $toolName]) 
                    ?? (new ConfigTools())
                    ->setToolreference($toolName)
                    ->setIdsite($siteId) // Set the site ID
                    ->setTooldatecreation((new \DateTime())->format('YmdHis')); // Set the current timestamp for tool date creation

            // Find or create the tool version
            $toolVersion = $em->getRepository(ConfigToolVersions::class)->findOneBy(['toolversiontext' => $toolVersionName]) 
                        ?? (new ConfigToolVersions())
                        ->setToolversiontext($toolVersionName) 
                        ->setIdsite($siteId)
                        ->setDatecreation(new \DateTime())
                        ->setArchived(false);

            // Persist new entities if they didn't exist
            if (!$machine->getIdcfgmachine()) $em->persist($machine);
            if (!$tool->getIdcfgtool()) $em->persist($tool);
            if (!$toolVersion->getIdcfgtoolversion()) $em->persist($toolVersion);

            $em->flush(); // Save new machine, tool, and version if created
            
            $imageFilename = null;
            if ($imageFile) {
                // Construct the filename with site, machine name, tool name, and tool version
                $imageFilename = sprintf(
                    '%s_%s_%s_%s_%s.%s',
                    $machine->getIdcfgmachine(),
                    $tool->getIdcfgtool(),
                    $toolVersion->getIdcfgtoolversion(),
                    (new \DateTime())->format('YmdHis'), // Add timestamp for uniqueness
                    $imageFile->getClientOriginalName(), // Original filename (or any other unique identifier)                    
                    $imageFile->guessExtension() // Use the correct file extension
                );
    
                // Move the image to the uploads directory
                $imageFile->move($this->getParameter('upload_directory'), $imageFilename);
            }
            // Call repository function to create a new SettingsStandardFile
            try {  
                $settingsFile = $em->getRepository(SettingsStandardFiles::class)->createNewSettingsStandardFile(
                    $siteId,
                    $machine->getIdcfgmachine(),
                    $tool->getIdcfgtool(),
                    $toolVersion->getIdcfgtoolversion(),
                    $imageFilename // Pass the image filename to the method
                );

                $this->addFlash('success', 'Standard File created successfully!');
                $this->session->set('idstdfile', $settingsFile->getId());
                return $this->redirectToRoute('template_data', ['idstdfile' => $settingsFile->getId()]);

            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('settings_standard_files/new.html.twig', [
            'sites' => $sites,
        ]);
    }

    /**
     * @Route("/template-data", name="template_data")
     */
    public function templateData(EntityManagerInterface $em, Request $request)
    {
        // Retrieve idstdfile from session
        $idstdfile = $this->session->get('idstdfile');
    
        // If still missing, show an error and redirect back to creating a new standard file
        if (!$idstdfile) {
            $this->addFlash('error', 'Standard File ID is missing.');
            return $this->redirectToRoute('settingsstandardfiles_new');
        }

        // Retrieve all parameters from SettingsStandardTemplate, ordered by idrank
        $parameters = $em->getRepository(SettingsStandardTemplate::class)
            ->findBy([], ['idrank' => 'ASC']);

        // Retrieve all files from SettingsStandardFiles
        $files = $em->getRepository(SettingsStandardFiles::class)->findAll();
    
        $filesdata = [];
        foreach($files as $file){
            $siteName = $em->getRepository(Sites::class)->findOneBy(['idsites' => $file->getIdsite()])->getSiteref();
            $machineName = $em->getRepository(ConfigMachines::class)->findOneBy(['idcfgmachine' => $file->getIdmachine()])->getMacreference();
            $toolName = $em->getRepository(ConfigTools::class)->findOneBy(['idcfgtool' => $file->getIdtool()])->getToolreference();
            $toolVersionName = $em->getRepository(ConfigToolVersions::class)->findOneBy(['idcfgtoolversion' => $file->getIdtoolversion()])->getToolversiontext();
            $filesdata[] = [
                'id' => $file->getId(),
                'siteName' => $siteName,
                'machineName' => $machineName,
                'toolName' => $toolName,
                'toolVersionName' => $toolVersionName,
            ]; 
        }
        if ($request->isMethod('POST')) {
            $formData = $request->request->all();
            $settingsData = [];

            // Extract form data dynamically based on input names
            foreach ($formData as $key => $value) {
                if (preg_match('/^(std_value|tolerance|mini|maxi|idrank|fieldname|fieldunit|nbdecimals)_(\d+)$/', $key, $matches)) {
                    $fieldType = $matches[1]; // e.g., std_value, tolerance, etc.
                    $idsettstdtemp = $matches[2];

                    if (!isset($settingsData[$idsettstdtemp])) {
                        $settingsData[$idsettstdtemp] = [
                            'std_value'  => null,
                            'tolerance'  => null,
                            'mini'       => null,
                            'maxi'       => null,
                            'idrank'     => null,
                            'fieldname'  => null,
                            'fieldunit'  => null,
                            'nbdecimals' => null,
                            'idsettstdfile' => $idstdfile,// Store standard file ID
                            'imageFilename' =>null,
                        ];
                    }

                    // Assign the extracted value
                    $settingsData[$idsettstdtemp][$fieldType] = $value;
                }
            }
            foreach ($parameters as $parameter) {
                // Construct the input name for the file
                $fileInputName = 'image_' . $parameter->getIdsettstdtemp();
                
                // Check if the file input exists and has been uploaded
                if ($request->files->has($fileInputName)) {
                    $file = $request->files->get($fileInputName);
            
                    // Check if the file is not null and is a valid uploaded file
                    if ($file && $file->isValid()) {
                        // Generate a unique filename
                        $filename = $parameter->getFieldname() . '_' . 
                        $parameter->getIdrank() . '_' . 
                        (new \DateTime())->format('YmdHis') . '_' . 
                        uniqid() . '.' . $file->guessExtension();

                        $uploadDir = $this->getParameter('upload_directory'); // e.g., 'public/uploads/'
            
                        try {
                            // Move the uploaded file to the server
                            $file->move($uploadDir, $filename);
                            
                            // Save the filename to the database
                            $settingsData[$parameter->getIdsettstdtemp()]['imageFilename'] = $filename;
                        } catch (FileException $e) {
                            // Handle file upload error
                            $this->addFlash('error', 'There was an error uploading the file.');
                        }
                    }
                }
            }            
            // Save data in SettingsStandard table
            foreach ($settingsData as $idsettstdtemp => $data) {
                $settingsStandard = new SettingsStandard();
                //$settingsStandard->setIdsettstdtemp($idsettstdtemp);
                $settingsStandard->setStdvalue($data['std_value']);
                $settingsStandard->setTolerancepct($data['tolerance']);
                $settingsStandard->setTolerancemini($data['mini']);
                $settingsStandard->setTolerancemaxi($data['maxi']);
                $settingsStandard->setIdrank($data['idrank']);
                $settingsStandard->setSettingdescription($data['fieldname']);
                $settingsStandard->setParamunit($data['fieldunit']);
                $settingsStandard->setIdsettstdfile($data['idsettstdfile']);
                $settingsStandard->setNbdecimals($data['nbdecimals']);
                $settingsStandard->setImageFilename($data['imageFilename']);
                $em->persist($settingsStandard);
            }

            $em->flush();

            $this->addFlash('success', 'Settings saved successfully!');
            return $this->redirectToRoute('settingsstandardfiles_index');
        }

        return $this->render('settings_standard_files/template_data.html.twig', [
            'parameters' => $parameters,
            'idstdfile' => $idstdfile,
            'files' => $filesdata,
        ]);
    }

    /**
     * @Route("/edit-settings", name="edit_settings_standard")
     */
    public function editSettingsStandard(EntityManagerInterface $em, Request $request)
    {
        $idSettStdFile = $request->query->get('idSettStdFile');
        // Fetch settings based on IdSettStdFile
        $settings = $em->getRepository(SettingsStandard::class)->findBy(['idsettstdfile' => $idSettStdFile]);
        $settingTemplates = $em->getRepository(SettingsStandardTemplate::class)->findBy([
            'idrank' => array_map(function($setting) { return $setting->getIdrank(); }, $settings)
        ]);;
        if (!$settings) {
            $this->addFlash('warning', 'No settings found for this file.');
            return $this->redirectToRoute('settingsstandardfiles_index');
        }

        if ($request->isMethod('POST')) {
            $formData = $request->request->all();
            //dump($formData);
            foreach ($settings as $setting) {
                $id = $setting->getId();
                //dump($id);
                if (isset($formData["std_value_$id"])) {
                    $setting->setStdvalue($formData["std_value_$id"]);
                    //dump($formData["std_value_$id"]);
                }
                if (isset($formData["tolerancepct_$id"])) {
                    $setting->setTolerancepct($formData["tolerancepct_$id"]);
                    //dump($formData["tolerancepct_$id"]);
                }
                if (isset($formData["tolerancemini_$id"])) {
                    $setting->setTolerancemini($formData["tolerancemini_$id"]);
                    //dump($formData["tolerancemini_$id"]);

                }
                if (isset($formData["tolerancemaxi_$id"])) {
                    $setting->setTolerancemaxi($formData["tolerancemaxi_$id"]);
                    //dump($formData["tolerancemaxi_$id"]);

                }
            }
            //exit();

            $em->flush();
            $this->addFlash('success', 'Settings updated successfully.');
            return $this->redirectToRoute('settingsstandardfiles_index');
        }

        return $this->render('settings_standard_files/edit_settings.html.twig', [
            'settings' => $settings,
            'settingTemplates' => $settingTemplates,
            'idSettStdFile' => $idSettStdFile,
        ]);
    }

    /**
     * @Route("/show-details-settings", name="settingsstandardfiles_show")
     */
    public function showSettingsFile(EntityManagerInterface $em,Request $request)
    {
        $idSettStdFile = $request->query->get('idSettStdFile');

        // Fetch the SettingsStandardFile by its ID
        $settingsFile = $em->getRepository(SettingsStandardFiles::class)->find($idSettStdFile);

        // If no file is found, redirect with an error
        if (!$settingsFile) {
            $this->addFlash('error', 'File not found.');
            return $this->redirectToRoute('settingsstandardfiles_index');
        }

        // Fetch related settings for this file
        $settings = $em->getRepository(SettingsStandard::class)->findBy(['idsettstdfile' => $idSettStdFile]);

        // Fetch related entities (Site, Machine, Tool, etc.)
        $site = $em->getRepository(Sites::class)->find($settingsFile->getIdsite());
        $machine = $em->getRepository(ConfigMachines::class)->find($settingsFile->getIdmachine());
        $tool = $em->getRepository(ConfigTools::class)->find($settingsFile->getIdtool());
        $toolVersion = $em->getRepository(ConfigToolVersions::class)->find($settingsFile->getIdtoolversion());

        return $this->render('settings_standard_files/show.html.twig', [
            'settingsFile' => $settingsFile,
            'settings' => $settings,
            'site' => $site,
            'machine' => $machine,
            'tool' => $tool,
            'toolVersion' => $toolVersion,
        ]);
    }
    /**
     * @Route("/file-hidden/{id}", name= "file_hidden")
     */
    public function fileHidden(int $id,EntityManagerInterface $em)
    {
        // Check if the user is in Group 1
        $isInGroup1 = UserLog::isUserInGroup($this->session, $em, 1);

        if (!$isInGroup1) {
            // If the user is not in Group 1, redirect with an error or show an error message
            $this->session->set('errorFlash', "You must be member of ADMIN group.");
            throw new AccessDeniedException('');
        }

        // Find the file
        $file = $em->getRepository(SettingsStandardFiles::class)->find($id);

        if ($file) {
            // Toggle the ActiveFile status
            $file->setActivefile(!$file->getActivefile());
            $em->flush(); // Save changes to the database
        }

        // Redirect back to the file list or the file's details page
        return $this->redirectToRoute('settingsstandardfiles_index');
    }
    /**
     * @Route("/settings/load-settings/{id}", name="load_settings")
     */
    public function loadSettings($id, EntityManagerInterface $em)
    {
        // Retrieve the settings from the selected file (settings_standard)
        $settings = $em->getRepository(SettingsStandard::class)->findBy(['idsettstdfile' => $id]);

        // Retrieve all parameters from SettingsStandardTemplate (settings_standard_template), ordered by idRank
        $parameters = $em->getRepository(SettingsStandardTemplate::class)->findBy([], ['idrank' => 'ASC']);
        
        // Prepare data in a format that can be used in the front end
        $settingsData = [];
        
        // Create an associative array of settings by idRank for easy lookup
        $settingsByIdRank = [];
        foreach ($settings as $setting) {
            // Map settings by idRank for easy lookup
            $settingsByIdRank[$setting->getIdRank()] = $setting;
        }
        
        // Now, loop through parameters and match with the settings by idRank
        foreach ($parameters as $param) {
            // Find the corresponding setting for each parameter by its idRank
            $setting = isset($settingsByIdRank[$param->getIdRank()]) ? $settingsByIdRank[$param->getIdRank()] : null;
            
            // Prepare the data for the front-end
            $settingsData[] = [
                'id' => $param->getId(), // Use parameter's ID here (from settings_standard_template)
                'std_value' => $setting ? $setting->getStdValue() : '', // If setting exists, use its value
                'tolerance' => $setting ? $setting->getTolerancePct() : null,
                'mini' => $setting ? $setting->getToleranceMini() : '',
                'maxi' => $setting ? $setting->getToleranceMaxi() : '',
            ];
        }

        return $this->json(['success' => true, 'settings' => $settingsData]);
    }
}
