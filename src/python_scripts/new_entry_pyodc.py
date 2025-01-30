#""" 
# -*- coding: utf-8 -*-
"""
Éditeur de Spyder

Ceci est un script temporaire.
"""

"""
Connects to a SQL database using pymssql
"""
import pymssql # MS SQL Server driver
import mysql.connector # MySQL driver
import datetime

#*** Variables ***
varSiteId = "120" # ESB = 120

mySqlConn = mysql.connector.connect(
    host="127.0.0.1",        # Host address, can be an IP or localhost
    port=3306,               # MySQL default port
    user="scada",            # Database username
    password="5c4d@!",       # Database password
    database="scada"   
)

#*** MS SQL Server connection ***
msSqlConn = pymssql.connect(
    server='10.61.2.42\\SQLSISE',
    user='cyclades',
    password='cyclades',
    database='ZEUROSTYLE',
    as_dict=True
)

mySqlCursor = mySqlConn.cursor()

Now_UTC = datetime.datetime.utcnow()
varStrNow = Now_UTC.strftime('%Y-%m-%d %H:%M:%S')
print("Start process - Check new tools - " + varStrNow)
varI = 0

#*** Log start ***
myQuery = "INSERT INTO scada.log_application (idLog,logDateTime,idSite,logType,logWriter,logText) "
myQuery = myQuery + "VALUES (0,'" + varStrNow + "'," + varSiteId + ",1,'Application','Start Process - Check new tools ESB 120 - " + varStrNow + "');"
#debug print(myQuery)
mySqlCursor.execute(myQuery)
mySqlConn.commit()

#*** Get the tool list from Scada database ***
myQuery = "SELECT DISTINCT ToolReference FROM scada.config_tools WHERE (idSite = " + varSiteId + ");"
mySqlCursor.execute(myQuery)
dsTools = mySqlCursor.fetchall()
tabTools = []
if (mySqlCursor.rowcount > 0):
    for row in dsTools:
        #debug print(row[0])
        tabTools.append(row[0])
#debug print(tabTools)
       
#*** Get the tool list from SISE records ***
myQuery = "SELECT [ID_SITE],[CONFIG_SITE],[REF_MOULD] FROM [ZEUROSTYLE].[dbo].[vw_Mould_list]"
msSqlCursor = msSqlConn.cursor()
msSqlCursor.execute(myQuery)
dsSiseTools = msSqlCursor.fetchall()

varI = 0
for row in dsSiseTools:
    print("Recherche moule " + row['REF_MOULD'])
    if row['REF_MOULD'] in tabTools:
        #*** Le moule existe déjà dans la base ***
        varRien = 0
        #debug print("Le moule existe déjà")
    else:
        #*** Le moule n'existe pas, il faut le créer ***
        Now_UTC = datetime.datetime.utcnow()
        varStrNow = Now_UTC.strftime('%Y%m%d%H%M%S')
        myQuery = "INSERT INTO scada.config_tools (idCfgTool,idSite,ToolReference,ToolDateCreation) "
        myQuery = myQuery + "VALUES (0," + str(row['ID_SITE']) + ",'" + row['REF_MOULD']+ "'," + varStrNow + ");"
        #debug print(myQuery)
        mySqlCursor.execute(myQuery)
        mySqlConn.commit()
        varI = varI + 1

#*** Log end ***
myQuery = "INSERT INTO scada.log_application (idLog,logDateTime,idSite,logType,logWriter,logText) "
myQuery = myQuery + "VALUES (0,'" + datetime.datetime.utcnow().strftime('%Y-%m-%d %H:%M:%S') + "'," + varSiteId + ",1,'Application','End process - Check new tools ESB 120 - " + datetime.datetime.utcnow().strftime('%Y-%m-%d %H:%M:%S') + " - Nb records : " + str(varI) + "');"
#debug print(myQuery)
mySqlCursor.execute(myQuery)
mySqlConn.commit()

#debug varStrNow = datetime.datetime.utcnow().strftime('%Y-%m-%d %H:%M:%S')
#debug print("End process - " + varStrNow + " - Nb records : " + str(varI))

#*** Close cursors and connections ***
mySqlCursor.close()
mySqlConn.close()
msSqlCursor.close()
msSqlConn.close()
