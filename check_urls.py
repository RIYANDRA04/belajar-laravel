import re, urllib.request

php_file = r'c:/Users/ASUS  TUF GAMING/Herd/belajar-laravel/database/seeders/ProductSeeder.php'
with open(php_file, 'r', encoding='utf-8') as f:
    content = f.read()
# Find all URLs in single quotes
urls = re.findall(r"'([^']+https?://[^']+)'", content)
print(f'Found {len(urls)} URLs')
invalid = []
for url in urls:
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req, timeout=10) as resp:
            if resp.status != 200:
                invalid.append((url, resp.status))
    except Exception as e:
        invalid.append((url, str(e)))
print('Invalid URLs:')
for u, err in invalid:
    print(u, '->', err)
