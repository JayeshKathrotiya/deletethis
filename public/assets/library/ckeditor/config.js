/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */



CKEDITOR.editorConfig = function( config ) {	
	// config.enterMode = CKEDITOR.ENTER_BR;
	//custome

	// config.selfClosingEnd = '';
	// config.forceEnterMode = true;
	// config.format_p = { element: 'p', attributes: { 'class': 'normalPara' } };	

	// CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.allowedContent = true;
	// config.disallowedContent = 'script';
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		// { name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		// '/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		// { name: 'youtube' },
		{ name: 'about' }
	];
	// push methods in ckeditor
	config.protectedSource.push( /<span class[\s\S]*?\>/g );
    config.protectedSource.push( /<\/span>/g );
    config.protectedSource.push( /<i class[\s\S]*?\>/g );
    config.protectedSource.push( /<\/i>/g );
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';
	config.uiColor = '#ffffff';
	// config.extraPlugins = 'youtube';
	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	// config.removeDialogTabs = 'image:advanced;link:advanced';
};
// CKEDITOR.editorConfig = function( config ) {
// 	config.language = 'es';
// 	config.uiColor = '#F7B42C';
// 	config.height = 300;
// 	config.toolbarCanCollapse = true;
// };
// CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
// CKEDITOR.config.autoParagraph = false;


// CKEDITOR.dataProcessor.writer.selfClosingEnd = '>';