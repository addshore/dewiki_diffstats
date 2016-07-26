import sys
import os.path
import time
import csv
import json

print "Running!"

if len(sys.argv) != 2:
    raise Exception('Not passed a log file.')
logFileLocation = sys.argv[1]
if os.path.isfile(logFileLocation) == False and os.access(logFileLocation, os.R_OK) == False:
    raise Exception('Can\'t read log file: ' + logFileLocation)

outputDirectory = os.path.join(os.path.dirname(os.path.realpath(__file__)),"output")
if not os.path.exists(outputDirectory):
    os.makedirs(outputDirectory)
outputFileLocation = os.path.join(outputDirectory,time.strftime('%Y-%m-%d_%H:%M:%S') + '.csv')

print "Input from: " + logFileLocation
print "Output to: " + outputFileLocation

with open(outputFileLocation, 'w') as outputHandle:
    headers = ['timestamp', 'oldid', 'newid', 'oldtimestamp', 'newtimestamp', 'pageid', 'revisions',
               'intermediate', 'olderrevs', 'newerrevs', 'revslider']
    headers.sort()
    writer = csv.DictWriter(outputHandle, fieldnames=headers)
    writer.writeheader()
    with open(logFileLocation) as inputHandle:
        for line in inputHandle:
            lineParts = line.split(' dewiki_diffstats DEBUG: dewiki diff page view ')
            data = json.loads(lineParts[1])
            writer.writerow(data)

print "Done!"
