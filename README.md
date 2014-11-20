Filter plugin for Statamic
======================

Plugin generate conditions text for {{ entries:listing }}.

## Install

1. Download and unpack
2. Put folders to **_add-ons** folder and to **_config/add-ons**

## Tags

Put tag `{{ filter }}` to conditions in `{{ entries:listing }}`.

Example

```
{{ entries:listing folder="blog" conditions="{ filter }" }}
  
  {{ title }}

{{ /entries:listing }}
```

### params_link

Tag generate **GET** params for url link.

```{{ filter:params_link }}```

Any params in tag, replaced or create **GET** value.

Example:

```html
<ul class="uk-subnav uk-subnav-pill">
    <li {{ if get:year == '2014' or get:year == '' }}class="uk-active"{{ /if }}>
      <a href="{{ filter:params_link year="2014" }}">2014</a>
    </li>
    <li {{ if get:year == '2013' }}class="uk-active"{{ /if }}>
      <a href="{{ filter:params_link year="2013" }}">2013</a>
    </li>
</ul>
```

## Config

All params need set in _config/add-ons/filter/filter.yaml

```yaml

year: # key name in GET 
  name: year # (not required) field name in your fields
  filter: int, abs, no_zero # (not required) filter list
  default: 2014 # (not required) default value if get param no set
  condition: "=>" # (not required) if you need a value not more or less.
```

### Filter list

- int
- any
- abs
- no_zero

