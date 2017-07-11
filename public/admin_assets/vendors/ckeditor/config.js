/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others', groups: [ 'others' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'colors', groups: [ 'colors' ] },
	];
	
	config.extraPlugins = 'colorbutton';
	
	config.allowedContent = true;
	
	config.removeButtons = 'Subscript,Superscript,Cut,Scayt,Undo,Redo,Copy,Paste,PasteText,PasteFromWord,Link,Unlink,Anchor,Image,Table,HorizontalRule,SpecialChar,Maximize,Strike,RemoveFormat,NumberedList,BulletedList,Indent,Outdent,Blockquote,Format';
};


//CKEDITOR.editorConfig = function( config ) {
//	// Define changes to default configuration here.
//	// For complete reference see:
//	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
//
//	// The toolbar groups arrangement, optimized for two toolbar rows.
//	config.toolbarGroups = [
//		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
//		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//		{ name: 'links' },
//		{ name: 'insert' },
//		{ name: 'forms' },
//		{ name: 'tools' },
//		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
//		{ name: 'others' },
//		'/',
//		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
//		{ name: 'styles' },
//		{ name: 'colors' , groups: [ 'colors' ]},
//		{ name: 'about' }
//	];
//
//	// Remove some buttons provided by the standard plugins, which are
//	// not needed in the Standard(s) toolbar.
//	//config.removeButtons = 'Underline,Subscript,Superscript';
//	
//	config.removeButtons = 'Copy,Cut,Paste,Undo,Redo,Print,Form,TextField,Textarea,Button,SelectAll,NumberedList,BulletedList,CreateDiv,Table,PasteText,PasteFromWord,Select,HiddenField';
//	
//	// Set the most common block elements.
//	config.format_tags = 'p;h1;h2;h3;pre';
//
//	// Simplify the dialog windows.
//	//config.removeDialogTabs = 'image:advanced;link:advanced';
//	
//	config.removePlugins = 'elementspath,save,image,flash,iframe,link,smiley,tabletools,find,pagebreak,templates,about,maximize,showblocks,newpage,language,font,editing,paragraph,styles,about,others';
//
//
//
//};