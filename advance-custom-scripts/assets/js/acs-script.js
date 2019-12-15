/*
* ACS scripts
*/
 'use strict';
 (function($){
    $(function(){
        
        var theme = jQuery('.editor-theme').attr('editor-theme');
        
        if( $('#acs_code_editor_page_html').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            
            var mixedMode = {
            name: "htmlmixed",
            scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                           mode: null},
                          {matches: /(text|application)\/(x-)?vb(a|script)/i,
                           mode: "vbscript"}]
            };
            
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: mixedMode,
                    theme: theme,
                    matchBrackets: true,
                    autoCloseTags: true,
                }
            );
            var editor = wp.codeEditor.initialize( $('#acs_code_editor_page_html'), editorSettings );
        }

        if( $('#acs_code_editor_page_js').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 4,
                    tabSize: 4,
                    mode: 'text/javascript',
                    matchBrackets: true,
                    theme: theme,
                }
            );
            var editor = wp.codeEditor.initialize( $('#acs_code_editor_page_js'), editorSettings );
        }

        if( $('#acs_code_editor_page_php').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'application/x-httpd-php',
                    theme: theme,
                    matchBrackets: true,
                }
            );
            var editor = wp.codeEditor.initialize( $('#acs_code_editor_page_php'), editorSettings );
        }

        if( $('#acs_code_editor_page_css').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'text/css',
                    theme: theme,
                    matchBrackets: true,
                }
            );
            var editor = wp.codeEditor.initialize( $('#acs_code_editor_page_css'), editorSettings );
        }
        
        
    });
     
 })(jQuery);

jQuery(document).ready(function(){
    //Hide all editor
    jQuery('#acs_code_editor_page_html, #acs_code_editor_page_js, #acs_code_editor_page_php, #acs_code_editor_page_css').next().css('display','none');
    
    //Hide all code title
    jQuery('.code-html, .code-css, .code-js, .code-php').css('display','none');
    
    //Hide all linking options
    jQuery('#html-sec, #css-sec, #js-sec').css('display','none');

    var html_selected = jQuery("input[value='html']:checked");
    if(html_selected.length){
        
        jQuery('#acs_code_editor_page_html').next().css('display','block');
        jQuery('.code-html').css('display','block');
        jQuery('.code-type').css('display','none');
        jQuery('#html-sec').css('display','block');
        
    }
    var css_selected = jQuery("input[value='css']:checked");
    if(css_selected.length){
                
        jQuery('#acs_code_editor_page_css').next().css('display','block');
        jQuery('.code-css').css('display','block');
        jQuery('.code-type').css('display','none');
        jQuery('#css-sec').css('display','block');
        
    }
    var js_selected = jQuery("input[value='js']:checked");
    if(js_selected.length){
                
        jQuery('#acs_code_editor_page_js').next().css('display','block');
        jQuery('.code-js').css('display','block');
        jQuery('.code-type').css('display','none');
        jQuery('#js-sec').css('display','block');
        
    }
    var php_selected = jQuery("input[value='php']:checked");
    if(php_selected.length){
                
        jQuery('#acs_code_editor_page_php').next().css('display','block');
        jQuery('.code-php').css('display','block');
        jQuery('.code-type').css('display','none');
        
    }
    
    //Hide priority input
//    jQuery('.acs-site-location').on('click', function(){
//        var siteLocation = jQuery(this).val();
//        if(siteLocation == 'admin'){
//            
//            jQuery('.acs-file-priority').removeAttr( "disabled", null );
//            
//        }else{
//            jQuery('.acs-file-priority').attr( "disabled", "" );
//        }
//        
//    });
    
});

function acs_editor_type(radioType){
    
    var editorType = radioType.value;
    if(editorType == 'html'){
        
        jQuery('#acs_code_editor_page_js, #acs_code_editor_page_php, #acs_code_editor_page_css').next().css('display','none');
        jQuery('#acs_code_editor_page_html').next().css('display','block');
        
        jQuery('.code-css, .code-js, .code-php, .code-type').css('display','none');
        jQuery('.code-html').css('display','block');
        
        jQuery('#css-sec, #js-sec').css('display','none');
        jQuery('#html-sec').css('display','block');
        
    }else if(editorType == 'css'){
        
        jQuery('#acs_code_editor_page_html, #acs_code_editor_page_js, #acs_code_editor_page_php').next().css('display','none');
        jQuery('#acs_code_editor_page_css').next().css('display','block');
        
        jQuery('.code-html, .code-js, .code-php, .code-type').css('display','none');
        jQuery('.code-css').css('display','block');
        
        jQuery('#html-sec, #js-sec').css('display','none');
        jQuery('#css-sec').css('display','block');
        
    }else if(editorType == 'js'){
        
        jQuery('#acs_code_editor_page_html, #acs_code_editor_page_php, #acs_code_editor_page_css').next().css('display','none');
        jQuery('#acs_code_editor_page_js').next().css('display','block');
        
        jQuery('.code-html, .code-css, .code-php, .code-type').css('display','none');
        jQuery('.code-js').css('display','block');
        
        jQuery('#html-sec, #css-sec').css('display','none');
        jQuery('#js-sec').css('display','block');
        
    }else if(editorType == 'php'){
        
        jQuery('#acs_code_editor_page_html, #acs_code_editor_page_js, #acs_code_editor_page_css').next().css('display','none');
        jQuery('#acs_code_editor_page_php').next().css('display','block');
        
        jQuery('.code-html, .code-css, .code-js, .code-type').css('display','none');
        jQuery('.code-php').css('display','block');
        
        jQuery('#html-sec, #css-sec, #js-sec').css('display','none');
    }
    
}

