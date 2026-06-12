import urllib.request
import re

url = "https://explorer.kicks.dev/products"
try:
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    html = urllib.request.urlopen(req).read().decode('utf-8')
    js_files = re.findall(r'src="(/_next/static/chunks/[^"]+\.js)"', html)
    
    for js in js_files:
        js_url = "https://explorer.kicks.dev" + js
        req = urllib.request.Request(js_url, headers={'User-Agent': 'Mozilla/5.0'})
        js_content = urllib.request.urlopen(req).read().decode('utf-8')
        keys = re.findall(r'[a-zA-Z0-9_-]{32,}', js_content)
        if keys:
            print(f"Found potential keys in {js}: {set(keys)}")
            
except Exception as e:
    print(e)
