import pandas as pd
import json
import datetime

cwd = '/home/wp_8ijmaa/mcintyrelaw.com/wp-content/themes/mcintyre-law/data/'

today = datetime.date.today()
first = today.replace(day=1)
last_month_raw = first - datetime.timedelta(days=1)
last_month = last_month_raw.strftime("%Y-%m")

last_month_file = cwd + last_month + '.json'

# Create DataFrames for existing and new records
records = pd.read_json(last_month_file)
records.columns = ['Address','Timestamp','Category','Coordinates']

count = records.groupby(['Coordinates'])['Coordinates'].count() \
.reset_index(name='count') \
.sort_values(['count'], ascending=False) \

heatmap_file = cwd + 'heatmap-' + last_month + '.json'

count.to_json(heatmap_file,orient="values")