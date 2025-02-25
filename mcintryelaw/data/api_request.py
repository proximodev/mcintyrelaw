# Note: In production this currently requires an additional cron: "pkill -f firefox"
# The pkill cron should be scheduled a minute before this one, which runs every 5 minutes

from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
from selenium.webdriver.common.by import By
import json
from datetime import datetime
import pandas as pd

# Declare current working directory
cwd = '/home/wp_8ijmaa/mcintyrelaw.com/wp-content/themes/mcintyre-law/data/'

# Set web driver options
options = FirefoxOptions()
options.add_argument('--headless')
driver = webdriver.Firefox(options=options)# Collect data

driver.get('https://data.okc.gov/services/portal/api/data/records/Emergency%20Responses')
elem = driver.find_element(By.ID, "json")

if elem:
    response = elem.get_attribute('innerHTML')
else:
    response = driver.page_source

# Close web driver
driver.quit()

# print(response)
data = json.loads(response)
records = data['Records']
# print(records)

if len(records) != 0:
    # Set script options
    all_json = cwd + "all.json"
    date_format = '%b %d %Y %I:%M%p'

    # Create DataFrames for existing and new records
    existing_records = pd.read_json(all_json)
    existing_records.columns = ['Address','Timestamp','Category','Coordinates']

    # print(existing_records)
    incoming_records = pd.DataFrame(records,columns=['ID','Address','Timestamp','Category','Coordinates'])

    # Filter incoming records to accidents only
    incoming_records = incoming_records[incoming_records['Category'].str.contains("ACCIDENT")]
    incoming_records = incoming_records.drop(columns=['ID'])
    # print(incoming_records)
    # Combine existing and incoming records to drop duplicates
    merged = existing_records.merge(incoming_records.drop_duplicates(), on=['Address','Timestamp','Category','Coordinates'], how='outer', indicator=True)
    # print(merged)

    # Convert date string to datetime object and extract year, month, and day
    merged['dt'] = pd.to_datetime(merged['Timestamp'], format=date_format)
    merged['year'] = merged['dt'].dt.strftime('%Y')
    merged['month'] = merged['dt'].dt.strftime('%Y-%m')
    merged['day'] = merged['dt'].dt.strftime('%Y-%m-%d')

    # Drop columns that are no longer needed
    df = merged.drop(columns=['dt'])

    # Get all unique years, months, and days in the list
    years = df.year.unique()
    months = df.month.unique()
    days = df.day.unique()
    
    # Save to files per year, month, day
    for y in years:
        fname = cwd + str(y) + '.json'
        this_df = df.loc[df['year'] == y] 
        this_df = this_df.drop(columns=['_merge','year','month','day'])
        this_df.to_json(fname,orient="values")

    for m in months:
        fname = cwd + str(m) + '.json'
        this_df = df.loc[df['month'] == m]
        this_df = this_df.drop(columns=['_merge','year','month','day'])
        this_df.to_json(fname,orient="values")

    for d in days:
        fname = cwd + str(d) + '.json'
        this_df = df.loc[df['day'] == d]
        this_df = this_df.drop(columns=['_merge','year','month','day'])
        this_df.to_json(fname,orient="values")
       
    # Save all records
    df = df.drop(columns=['_merge','year','month','day'])
    df.to_json(all_json,orient="values")

    stats_file = cwd + "stats.py"
    exec(open(stats_file).read())
    heatmap_file = cwd + "heatmap.py"
    exec(open(heatmap_file).read())
    heatmap_file = cwd + "heatmap-ytd.py"
    exec(open(heatmap_file).read())