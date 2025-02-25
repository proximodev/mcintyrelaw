import pandas as pd
import json
import datetime

cwd = '/home/wp_8ijmaa/mcintyrelaw.com/wp-content/themes/mcintyre-law/data/'

this_year = datetime.datetime.now().year
this_year_file = cwd + str(this_year) + '.json'

# Create DataFrames for existing and new records
records = pd.read_json(this_year_file)
records.columns = ['Address','Timestamp','Category','Coordinates']

count = records.groupby(['Coordinates'])['Coordinates'].count() \
.reset_index(name='count') \
.sort_values(['count'], ascending=False) \

heatmap_file = cwd + 'heatmap-' + str(this_year) + '.json'

count.to_json(heatmap_file,orient="values")