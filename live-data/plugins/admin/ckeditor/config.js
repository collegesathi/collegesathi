/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	config.extraPlugins = 'uploadimage,uploadwidget';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
	config.allowedContent = true;
	config.extraAllowedContent = 'div(*);ul;li;table;td;style;*[id];*(*);*{*}';
	
	
	config.filebrowserBrowseUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = WEBSITE_URL+'plugins/admin/ckeditor/plugins/kcfinder/upload.php?type=flash';

	config.removePlugins = 'dragdrop,basket,flash';
	
	config.contentsCss = [WEBSITE_URL+'css/bootstrap.min.css', WEBSITE_URL+'css/style.css'];
};
