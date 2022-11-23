/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    config.language = 'en';
    config.skin = 'office2013';
    config.extraPlugins = 'wysiwygarea,toolbar,basicstyles,menubutton,link,sourcearea,widget,button,toolbar,notification,notificationaggregator,' +
        'clipboard,filetools,fakeobjects,dialogui,dialog,clipboard,colordialog,lineutils,widget,widgetbootstrap,fakeobjects,uploadwidget,link,' +
        'bootstrapAlert,bootstrapButtons,bootstrapCarousel,bootstrapCollapse,bootstrapListGroup,bootstrapTab,' +
        'uicolor,youtube,clipboard,uploadwidget,imageuploader';
    /**        
     * config.contentsCss = ['/www/css/font-awesome/css/font-awesome.css', 
     *     '/www/css/bootstrap/css/bootstrap.css',    
      *    '/www/css/bootstrap/css/bootstrap-theme.css'
      *    '/www/css/navrh1.22krovnosti.itprojekt.eu/css/style-main.css',
      *    '/www/css/navrh1.22krovnosti.itprojekt.eu/css/style.css'
     * ];
     *  */

    // config.contentsCss = ['/www/css/font-awesome/css/font-awesome.css',
    //     '/www/css/bootstrap/css/bootstrap.css',
    //     '/www/css/bootstrap/css/bootstrap-theme.css'
    // ];

    config.font_names = 'Open Sans;Font Awesome;' + config.font_names;
    config.allowedContent = true;
    config.bootstrapCarousel_fileManager = 'filemanager';
    config.bootstrapCarousel_managePopupTitle = true;
    config.bootstrapCarousel_managePopupCaption = true;
    config.bootstrapCollapse_managePopupContent = true;
    config.bootstrapListGroup_managePopupContent = true;
    //    config.bootstrapPanel_managePopupContent = true; 
    config.bootstrapTab_managePopupContent = true;
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_related = false;
    config.toolbar = [
        { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'] },
        { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
        { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
        { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
        '/',
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
        { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
        { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
        '/',
        { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: ['TextColor', 'BGColor'] },
        { name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About'] },
        {
            name: 'insert', items: ['-', 'Fontawesome', 'BootstrapAlert', 'BootstrapButtons', 'BootstrapCarousel', 'BootstrapCollapse',
                'BootstrapListGroup', 'BootstrapTab', '-', 'Youtube', 'FontAwesome', 'WidgetTemplateMenu', 'WidgetTemplateMenu']
        }, //,'BootstrapPanel' ] }
        // { name: 'CKAwesome', items: ['Image', 'ckawesome'] }
    ];
    // config.height = "800px";
    config.uicolor = 'skyblue';
    config.autoParagraph = false;
    // config.filebrowserBrowseUrl = '/filemanager?type=Images';
    // config.filebrowserImageBrowseUrl = '/filemanager?type=Images';
    // config.filebrowserFlashBrowseUrl = '/filemanager?type=Images';
    // config.fontawesomePath = '/www/css/font-awesome/css/font-awesome.min.css';


    CKEDITOR.dtd.$removeEmpty['span'] = false;
    CKEDITOR.dtd.$removeEmpty['i'] = false;
    config.protectedSource.push(/<i[^>]*><\/i>/g);
};
