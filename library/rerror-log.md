apple@MBPro-15 plugin-theme-settings % phpcs .

## FILE: ...content/plugins/plugin-theme-settings/inc/class-tabbed-settings.php

## FOUND 63 ERRORS AND 29 WARNINGS AFFECTING 46 LINES

4 | ERROR | There must be exactly one blank line after the file
| | comment
4 | ERROR | Missing @package tag in file comment
9 | ERROR | Missing doc comment for function
| | sidetrack_mailchimp_admin_init()
10 | WARNING | Found precision alignment of 1 spaces.
21 | ERROR | Missing doc comment for function
| | sidetrack_mailchimp_settings_page_init()
22 | WARNING | Found precision alignment of 1 spaces.
26 | ERROR | The $text arg must be a single string literal, not
     |         | "$plugin_data['Name'].' Settings'".
26 | ERROR | The $text arg must be a single string literal, not
     |         | "$plugin_data['Name']".
30 | ERROR | Missing doc comment for function
| | sidetrack_mailchimp_load_settings_page()
31 | ERROR | Processing form data without nonce verification.
31 | ERROR | Use Yoda Condition checks, you must.
34 | ERROR | Missing wp_unslash() before sanitization.
34 | ERROR | Detected usage of a non-sanitized input variable: $_GET
  35 | WARNING | wp_redirect() found. Using wp_safe_redirect(), along
     |         | with the allowed_redirect_hosts filter if needed, can
     |         | help avoid any chances of malicious redirects within
     |         | code. It is also important to remember to call exit()
     |         | after a redirect so that no other unwanted code is
     |         | executed.
  40 | ERROR   | Missing doc comment for function
     |         | sidetrack_mailchimp_save_tabbed_settings()
  44 | WARNING | Found: ==. Use strict comparisons (=== or !==).
  44 | ERROR   | Use Yoda Condition checks, you must.
  44 | WARNING | Processing form data without nonce verification.
  44 | ERROR   | Detected usage of a non-validated input variable: $_GET
  44 | WARNING | Found: ==. Use strict comparisons (=== or !==).
  44 | ERROR   | Use Yoda Condition checks, you must.
  45 | WARNING | Processing form data without nonce verification.
  46 | WARNING | Processing form data without nonce verification.
  46 | ERROR   | Missing wp_unslash() before sanitization.
  46 | ERROR   | Detected usage of a non-sanitized input variable: $_GET
  53 | ERROR   | Detected usage of a non-validated input variable:
     |         | $_POST
  53 | ERROR   | Missing wp_unslash() before sanitization.
  53 | ERROR   | Detected usage of a non-sanitized input variable:
     |         | $_POST
  53 | ERROR   | Processing form data without nonce verification.
  56 | ERROR   | Detected usage of a non-validated input variable:
     |         | $_POST
  56 | ERROR   | Missing wp_unslash() before sanitization.
  56 | ERROR   | Detected usage of a non-sanitized input variable:
     |         | $_POST
  56 | ERROR   | Processing form data without nonce verification.
  59 | ERROR   | Detected usage of a non-validated input variable:
     |         | $_POST
  59 | ERROR   | Missing wp_unslash() before sanitization.
  59 | ERROR   | Detected usage of a non-sanitized input variable:
     |         | $_POST
  59 | ERROR   | Processing form data without nonce verification.
  62 | ERROR   | Detected usage of a non-validated input variable:
     |         | $_POST
  62 | ERROR   | Missing wp_unslash() before sanitization.
  62 | ERROR   | Detected usage of a non-sanitized input variable:
     |         | $_POST
  62 | ERROR   | Processing form data without nonce verification.
  78 | ERROR   | Missing doc comment for function
     |         | sidetrack_mailchimp_admin_tabs()
  89 | WARNING | Found: ==. Use strict comparisons (=== or !==).
  90 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '"<a class='nav-tab$class'
| | href='?page=sidetrack-mailchimp&tab=$tab'>$name</a>"'.
95 | ERROR | Missing doc comment for function
| | get_sidetrack_mailchimp_setup_data()
96 | WARNING | Found precision alignment of 1 spaces.
99 | ERROR | Missing doc comment for function
| | sidetrack_mailchimp_settings_page()
104 | WARNING | Found precision alignment of 1 spaces.
106 | ERROR | All output should be run through an escaping function
| | (see the Security sections in the WordPress Developer
| | Handbooks), found '**'.
106 | ERROR | The $text arg must be a single string literal, not
     |         | "$plugin_data['Name'].' Settings'".
165 | WARNING | Found precision alignment of 1 spaces.
179 | WARNING | Processing form data without nonce verification.
179 | WARNING | Processing form data without nonce verification.
179 | ERROR | Missing wp_unslash() before sanitization.
179 | ERROR | Detected usage of a non-sanitized input variable: $\_GET
180 | ERROR | All output should be run through an escaping function
| | (see the Security sections in the WordPress Developer
| | Handbooks), found '**'.
183 | WARNING | Processing form data without nonce verification.
184 | WARNING | Processing form data without nonce verification.
184 | ERROR | Missing wp_unslash() before sanitization.
184 | ERROR | Detected usage of a non-sanitized input variable: $_GET
 193 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 193 | WARNING | Processing form data without nonce verification.
 193 | WARNING | Processing form data without nonce verification.
 193 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '$\_GET'.
193 | ERROR | Missing wp_unslash() before sanitization.
193 | ERROR | Detected usage of a non-sanitized input variable: $_GET
 197 | WARNING | Found: ==. Use strict comparisons (=== or !==).
 197 | ERROR   | Use Yoda Condition checks, you must.
 197 | WARNING | Processing form data without nonce verification.
 197 | ERROR   | Detected usage of a non-validated input variable: $_GET
 197 | WARNING | Found: ==. Use strict comparisons (=== or !==).
 197 | ERROR   | Use Yoda Condition checks, you must.
 198 | WARNING | Processing form data without nonce verification.
 199 | WARNING | Processing form data without nonce verification.
 199 | ERROR   | Missing wp_unslash() before sanitization.
 199 | ERROR   | Detected usage of a non-sanitized input variable: $_GET
 208 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 212 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 230 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 242 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 254 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 258 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 265 | WARNING | print_r() found. Debug code should not normally be used
     |         | in production.
 276 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '__'.
 277 | WARNING | Processing form data without nonce verification.
 277 | WARNING | Processing form data without nonce verification.
 277 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '$\_GET'.
277 | ERROR | Missing wp_unslash() before sanitization.
277 | ERROR | Detected usage of a non-sanitized input variable: $\_GET
278 | WARNING | Processing form data without nonce verification.
278 | WARNING | Processing form data without nonce verification.
287 | WARNING | print_r() found. Debug code should not normally be used
| | in production.

---

## FILE: ...t/plugins/plugin-theme-settings/inc/class-plugin-theme-settings.php

## FOUND 20 ERRORS AND 1 WARNING AFFECTING 18 LINES

1 | ERROR | Class file names should be based on the class name with
| | "class-" prepended. Expected
| | class-plugin-or-theme-settings.php, but found
| | class-plugin-theme-settings.php.
1 | ERROR | Missing file doc comment
7 | ERROR | Class name is not valid; consider
| | Plugin_Or_Theme_Settings instead
7 | ERROR | Missing doc comment for class Plugin_or_Theme_Settings
10 | ERROR | Missing doc comment for function **construct()
14 | ERROR | Missing doc comment for function add_admin_menu()
19 | ERROR | Missing doc comment for function
| | plugin_or_theme_settings_init()
71 | ERROR | Missing doc comment for function
| | select_field_0_render()
85 | ERROR | Missing doc comment for function text_field_0_render()
89 | ERROR | All output should be run through an escaping function
| | (see the Security sections in the WordPress Developer
| | Handbooks), found '$options'.
  93 | ERROR   | Missing doc comment for function
     |         | checkbox_field_0_render()
 101 | ERROR   | Missing doc comment for function
     |         | textarea_field_0_render()
 105 | ERROR   | All output should be run through an escaping function
     |         | (see the Security sections in the WordPress Developer
     |         | Handbooks), found '$options'.
109 | ERROR | Missing doc comment for function radio_field_0_render()
121 | ERROR | Missing doc comment for function
| | plugin_or_theme_settings_section_callback()
123 | ERROR | All output should be run through an escaping function
| | (see the Security sections in the WordPress Developer
| | Handbooks), found '**'.
123 | ERROR | The $text arg must be a single string literal, not
| | "'<em style="padding:1rem;">This description is found
| | in this function <b>'.**FUNCTION**.' </b>and provides
| | an paragraph-type area below the headings and above the
| | individual settings.</em>'".
126 | ERROR | Missing doc comment for function options_page()
144 | ERROR | Missing doc comment for function
| | plugin_or_theme_settings_render()
147 | WARNING | print_r() found. Debug code should not normally be used
| | in production.
151 | ERROR | Missing doc comment for function
| | plugin_or_theme_settings_todo()

---
