---
trigger: always_on
---

{
"rule_name": "replace_grep_with_findstr_windows",
"description": "Automatically replaces grep with findstr when running commands on Windows shells",
"conditions": {
"os": ["windows"],
"shell": ["powershell", "cmd"],
"command_contains": ["grep"]
},
"transformations": [
{
"type": "regex_replace",
"pattern": "(^|\\s|\\|)grep(\\s+)",
"replacement": "$1findstr$2"
}
],
"flag_mappings": [
{
"from": "grep -i",
"to": "findstr /I"
},
{
"from": "grep -v",
"to": "findstr /V"
},
{
"from": "grep -n",
"to": "findstr /N"
}
],
"safety": {
"avoid_inside_strings": true,
"avoid_filenames": true
},
"enabled": true,
"priority": 100
}
