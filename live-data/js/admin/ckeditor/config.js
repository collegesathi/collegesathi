/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 //config.language = 'ar';
	// config.uiColor = '#AADC6E';
	config.skin='office2013';
	config.toolbar = 'MyToolbar';
	config.basicEntities = false;
	config.toolbar_MyToolbar =
	[
		{ name: 'document', items : [ 'Source','Preview','Templates' ] },
		{ name: 'insert', items : [ 'Image','Table' ] },
        { name: 'basicstyles', items : [ 'Bold','Italic'] },
		{ name: 'links', items : [ 'Link','Unlink' ] },
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste' ] },
	];
	config.allowedContent = true;
	config.extraAllowedContent = 'div(*);ul;li;table;td;style;*[id];*(*);*{*}';

	config.removePlugins = 'dragdrop,basket,filebrowser,flash,fakeobjects';
};
CKEDITOR.on('instanceReady', function (ev) {
   // Prevent drag-and-drop.
   ev.editor.document.on('drop', function (ev) {
      ev.data.preventDefault(true);
   });
});
