Statamic-filter-plugin
======================

Plugin filter get params for Statamic CMS.

Plugin generate conditions text for {{ entries:listing }}.

## Install
  
  1. Download and unpack
  2. Put folders to _add-ons folder and to _config/add-ons
  
## Tags
  
  Put tag {{ filter }} to conditions in {{ entries:listing }}.
  
  Example
  
  ```
     {{ entries:listing folder="blog" conditions="{ filter }" }} {{ title }} {{ /entries:listing }}
  ```
  
  ### params_link
  
  Tag generate get params for url link.
  
  ```{{ filter:params_link }}```
  
  Example:
  
  ```html
    <ul class="uk-subnav uk-subnav-pill">
              <li {{ if get:year == '2014' or get:year == '' }}class="uk-active"{{ /if }}><a href="{{ filter:params_link year="2014" }}">2014</a></li>
              <li {{ if get:year == '2013' }}class="uk-active"{{ /if }}><a href="{{ filter:params_link year="2013" }}">2013</a></li>
          </ul>
          
  ```
  
  
## Config

