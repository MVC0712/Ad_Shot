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
response = {"res": "OK"}

print('Content-type: text/html\nAccess-Control-Allow-Origin: *\n')
print("\n\n")
print(json.JSONEncoder().encode(response))
print('\n')

wb = openpyxl.load_workbook('SummaryReport.xlsx')
sheet = wb.get_sheet_by_name('Data')

# print(start)
# print(end)

wb.save("../FileDownLoad/Excel/" + start + "_" + end + "_ReportShot.xlsx")
