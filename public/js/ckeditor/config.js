/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// 
	

	//config.filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images';
    //config.filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}';
    //config.filebrowserBrowseUrl: '/laravel-filemanager?type=Files';
    //config.filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}';


	//var csrf = '{{csrf_token()}}';
	console.log('token', $("#token").val());
	
	var path = CKEDITOR.basePath.split('/');
	path[ path.length-2 ] = 'upload_image';
	config.filebrowserUploadUrl = path.join('/').replace(/\/+$/, '')+'?_token='+$("#token").val();

	console.log(path.join('/').replace(/\/+$/, '')+'?_token='+$("#token").val());

	// Add plugin
	config.extraPlugins = 'filebrowser';
	//
	//
	/*config.filebrowserBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=flash';*/
};
