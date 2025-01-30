# -*- coding: utf-8 -*-
"""
Éditeur de Spyder

Ceci est un script temporaire.
"""

"""
Connects to a SQL database using pymssql
"""
import pymssql  # MS SQL Server driver
import mysql.connector  # MySQL driver
import datetime

#*** Variables ***
varSiteId = "120"  # ESB = 120

# MySQL connection
mySqlConn = mysql.connector.connect(
    host="127.0.0.1",  # Host address, can be an IP or localhost
    port=3306,  # MySQL default port
    user="scada",  # Database username
    password="5c4d@!",  # Database password
    database="scada"
)

# MS SQL Server connection
msSqlConn = pymssql.connect(
    server='10.61.2.42\\SQLSISE',
    user='cyclades',
    password='cyclades',
    database='ZEUROSTYLE',
    as_dict=True
)

mySqlCursor = mySqlConn.cursor()

varStrNow = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
print("Start process - " + varStrNow)
varI = 0

#*** Log start ***
myQuery = "INSERT INTO scada.log_application (idLog,logDateTime,idSite,logType,logWriter,logText) "
myQuery = myQuery + "VALUES (0,'" + varStrNow + "'," + varSiteId + ",1,'Application','Start Process - " + varStrNow + "');"
#print(myQuery)
mySqlCursor.execute(myQuery)
mySqlConn.commit()

#*** Get the last import ***
myQuery = "SELECT idLastDataImp,idSite,LastIdCyc,dbName FROM scada.last_data_import WHERE (idSite=" + varSiteId + ");"
mySqlCursor.execute(myQuery)
rowLastImport = mySqlCursor.fetchone()
if (mySqlCursor.rowcount > 0):
    # mySqlCursor.close()
    print(rowLastImport)
    print(f"{rowLastImport[1]}\t\t{rowLastImport[2]}\t\t{rowLastImport[3]}")
    #*** Log last import ***
    myQuery = "INSERT INTO scada.log_application (idLog,logDateTime,idSite,logType,logWriter,logText) "
    myQuery = myQuery + "VALUES (0,'" + varStrNow + "'," + varSiteId + ",1,'Application','Last IdCyc : " + str(rowLastImport[2]) + "');"
    # print(myQuery)
    mySqlCursor.execute(myQuery)
    mySqlConn.commit()

    #*** Get new data from SISE Scada ***
    myQuery = "SELECT TOP(30000) ID_SITE,CONFIG_SITE,Id,REF_MACHINE,REF_MOULD,[DATE], FORMAT([DATE],'yyyy-MM-dd HH:mm:ss') AS DATE_YYYYMMDD,CYCLE_ID,[NAME],[VALUE],IDCFGPARAM "
    myQuery = myQuery + "FROM ZEUROSTYLE.dbo.vw_Scada_values "
    myQuery = myQuery + "WHERE (ID_SITE=" + varSiteId
    myQuery = myQuery + ") AND (Id > " + str(rowLastImport[2])
    myQuery = myQuery + ") ORDER BY Id"
    # print("myQuery : " + myQuery)
    msSqlCursor = msSqlConn.cursor()
    msSqlCursor.execute(myQuery)
    dsSiseData = msSqlCursor.fetchall()
    # print("Trace 102. msSqlCursor.rowcount : " + str(msSqlCursor.rowcount))
    if (msSqlCursor.rowcount > 0):
        # print("Trace 104")
        #*** Get machine list ***
        myQuery = "SELECT idCfgMachine,idSite,MacReference,MacDescription "
        myQuery = myQuery + "FROM scada.config_machines "
        myQuery = myQuery + "WHERE (idSite=" + varSiteId
        myQuery = myQuery + ") ORDER BY MacReference;"
        # print("myQuery : " + myQuery)
        mySqlCursor.execute(myQuery)
        dictMac = {}
        for row in mySqlCursor.fetchall():
            values = {}
            for i, value in enumerate(row):
                values[mySqlCursor.description[i][0]] = value
            dictMac[row[2]] = values
        # print(dictMac)

        #*** Get tool list ***
        myQuery = "SELECT idCfgTool,idSite,ToolReference "
        myQuery = myQuery + "FROM scada.config_tools "
        myQuery = myQuery + "WHERE (idSite=" + varSiteId
        myQuery = myQuery + ") ORDER BY ToolReference;"
        # print("myQuery : " + myQuery)
        mySqlCursor.execute(myQuery)
        dictTool = {}
        for row in mySqlCursor.fetchall():
            values = {}
            for i, value in enumerate(row):
                values[mySqlCursor.description[i][0]] = value
            dictTool[row[2]] = values
        # print(dictTool)

        # Process each row from the Scada data
        for row in dsSiseData:
            # Check if the REF_MACHINE and REF_MOULD are in the dicts
            if row['REF_MACHINE'] not in dictMac:
                print(f"Warning: REF_MACHINE '{row['REF_MACHINE']}' not found in dictMac")
                continue  # Skip this iteration if the machine is not found

            if row['REF_MOULD'] not in dictTool:
                print(f"Warning: REF_MOULD '{row['REF_MOULD']}' not found in dictTool")
                continue  # Skip this iteration if the mould is not found

            # Safely access the dicts after checking if the key exists
            myQuery = "INSERT INTO scada.records (idrecords,idsite,idMac,idMould,DateRecord,idCyc,CYCLE_ID,idParameter,ParamValue) "
            myQuery = myQuery + "VALUES (0," + varSiteId + "," + str(dictMac[row['REF_MACHINE']]['idCfgMachine']) + "," + str(dictTool[row['REF_MOULD']]['idCfgTool']) + ",'"
            myQuery = myQuery + row['DATE_YYYYMMDD'] + "'," + str(row['Id']) + "," + str(row['CYCLE_ID'])
            myQuery = myQuery + "," + str(row['IDCFGPARAM']) + ",'" + row['VALUE'] + "');"
            # print("myQuery : " + myQuery)
            mySqlCursor.execute(myQuery)
            mySqlConn.commit()
            varI = varI + 1

        # Update the last import record
        myQuery = "UPDATE scada.last_data_import SET LastIdCyc=" + str(row['Id']) + ",dateModification='" + datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        myQuery = myQuery + "' WHERE (idLastDataImp=" + str(rowLastImport[0]) + ");"
        mySqlCursor.execute(myQuery)
        mySqlConn.commit()

#*** Log end ***
myQuery = "INSERT INTO scada.log_application (idLog,logDateTime,idSite,logType,logWriter,logText) "
myQuery = myQuery + "VALUES (0,'" + datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S') + "'," + varSiteId + ",1,'Application','End process - " + datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S') + " - Nb records : " + str(varI) + "');"
mySqlCursor.execute(myQuery)
mySqlConn.commit()

varStrNow = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
print("End process - " + varStrNow + " - Nb records : " + str(varI))

#*** Close cursors and connections ***
mySqlCursor.close()
mySqlConn.close()
msSqlCursor.close()
msSqlConn.close()
