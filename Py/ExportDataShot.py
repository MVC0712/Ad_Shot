#!C:\python\python3.9\python.exe
# -*- coding: utf-8 -*-
import cgitb
import cgi
import os
import json
import sys
import io
import urllib.parse
import openpyxl

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

cgitb.enable()

data = sys.stdin.read()
params = json.loads(data)
end = params[len(params) - 1]
start = params[len(params) - 2]
del params[-1]
del params[-1]
response = {"res": "OK"}

print('Content-type: text/html\nAccess-Control-Allow-Origin: *\n')
print("\n\n")
print(json.JSONEncoder().encode(response))
print('\n')

wb = openpyxl.load_workbook('SummaryReport.xlsx')
sheet = wb.get_sheet_by_name('Data')

# print(start)
# print(end)
# print(params)

sheet.append(list(params[0]))

for index, value in enumerate(params):
    val = list(value.values())
    sheet.append(val)
    
    # if (index + 1) % 4 == 0:
        # sheet.insert_rows(index + 3)
        # print(index+3)

wb.save("../FileDownLoad/Excel/" + start + "_" + end + "_ReportShot.xlsx")
