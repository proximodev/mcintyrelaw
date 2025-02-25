from datetime import datetime, timezone
from calendar import monthrange
import pytz
import json
import pandas as pd

# Declare current working directory
cwd = '/home/wp_8ijmaa/mcintyrelaw.com/wp-content/themes/mcintyre-law/data/'
date_format = '%b %d %Y %I:%M%p'

# Get current date as string
this_month = str(datetime.now(pytz.timezone('US/Central')))

# Get current year + month string by grabbing first 7 characters of above: YYYY-MM as string
this_month = this_month[:7]

# Get this month's filepath
month_file = cwd + this_month + '.json'
# print(month_file)

# Get first and last day of month
yr = int(this_month[:4])
mo = int(this_month[-2:])
first_day = this_month + '-' + '01'
last_day = this_month + '-' + str(monthrange(yr, mo)[1])

# Load the month file into a dataframe
df = pd.read_json(month_file)
df.columns = ['Address','Timestamp','Category','Coordinates']

# Convert date string to datetime object and extract day
df['dt'] = pd.to_datetime(df['Timestamp'], format=date_format)
df['day'] = df['dt'].dt.strftime('%Y-%m-%d')

# get count per day
df = df.groupby('day').size().reset_index(name='count')

df['day'] = pd.to_datetime(df['day'])
df = (df.set_index('day')
    .reindex(pd.date_range(first_day, last_day, freq='D'))
    .rename_axis(['day'])
    .fillna('N/A')
    .reset_index())
# df['count'] = df['count'].astype(int)
df['day'] = df['day'].dt.strftime('%d')

# Store the counts in a file called "YYYY-MM-stats.json"
stats_file = cwd + 'stats-' + this_month + '.json'
df.to_json(stats_file,orient="records")