<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');
Route::post('getCantidad_Publicaciones','IndexController@getCantidad_Publicaciones');
Route::post('getLoad_Publicaciones','IndexController@getLoad_Publicaciones');

Route::get('contact', 'Web_ContactController@index');
Route::get('publicacion_completa/{id_fpublicacion}', 'Web_PublicacionCompletaController@index')->name('publicacion_completa');
Route::get('publicacion/{id_ftp}', 'Web_PublicacionController@index')->name('publicacion');
Route::get('publicacionUser/{id}', 'Web_PublicacionController@searchPublicacionUser')->name('publicacionUser');
Route::get('carrera/{id_carrera}', 'Web_CarreraController@index')->name('carrera');
Route::post('carrera/malla_listaDependencias','Web_CarreraController@listaDependencias');
Route::get('uti', 'Web_UtiController@index');
Route::get('materias', 'Web_MateriaController@index');


Route::get('all_publicacion', 'Web_AllPublicacionController@index')->name('all_publicacion');
Route::get('all_publicacion_search', 'Web_AllPublicacionController@search')->name('all_publicacion_search');

Route::get('welcome', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('home', 'HomeController@index');
Route::post('listar_usuarios_mensaje','HomeController@listar_usuarios_mensaje');


Route::get('adminFuncion', 'FuncionController@index');

//ruta para crud funciones
Route::resource('funciones', 'FuncionesController');
Route::resource('adminFuncion', 'FuncionController');
Route::delete('destroyTarea/{id}','FuncionesController@destroyTarea')->name('destroyTarea');

//ruta para crud tarea
Route::resource('tareas', 'TareasController');
Route::get('tareasCrear/{funcion}', 'TareasController@create2')->name('tareasCrear');

//ruta para crud de rol
Route::get('adminRol', 'RolesController@index');
Route::resource('roles', 'RolesController');

//rutas para tareas_roles
Route::get('adminTareasRoles/{id}','TareasRolesController@adminRol')->name('adminTareasRoles');
Route::resource('tareasroles','TareasRolesController');

//rutas para usuarios
Route::get('adminUsuario', 'UsuarioController@index');
Route::get('usuariossearch', 'UsuarioController@search')->name('usuariossearch');
Route::resource('usuarios','UsuarioController');
Route::put('usuarios_rol/{id}','UsuarioController@update_rol')->name('usuarios_rol');

//rutas para usuarios_tareas
Route::get('adminUsuariosTareas/{id}','UsuariosTareasController@adminUsuario')->name('adminUsuriosTareas');
Route::resource('usuariostareas','UsuariosTareasController');


//rutas para tareas_usuarios
Route::get('adminTareasUsuarios/{id}','TareasUsuariosController@adminTarea')->name('adminTareasUsuarios');
Route::resource('tareasusuarios','TareasUsuariosController');


//rutas para registro usuarios
Route::get('adminRegistrosUsuarios', 'RegistroUsuarioController@index');
Route::get('registrosUsuariosSearch', 'RegistroUsuarioController@search')->name('registrosUsuariosSearch');
Route::resource('registrousuario','RegistroUsuarioController');


//rutas para perfil
Route::resource('settings','PerfilController');
Route::post('perfilEdit','PerfilController@perfilEdit');
Route::post('perfilPassword','PerfilController@perfilPassword');
Route::post('perfilBiografia','PerfilController@perfilBiografia');


//rutas para carrera
Route::get('sistemaCarrera','CarrerasController@index');
Route::get('carrerasSearch', 'CarrerasController@search')->name('carrerasSearch');
Route::resource('carreras','CarrerasController');
Route::post('carreraAdd','CarrerasController@carreraAdd');
Route::post('carreraEdit','CarrerasController@carreraEdit');
Route::post('carreraEstado','CarrerasController@carreraEstado');
Route::post('carreraDelete','CarrerasController@carreraDelete');
Route::post('carreraCantidadMaterias','CarrerasController@carreraCantidadMaterias');


//rutas para materia
Route::get('sistemaMateria/{id_carrera}','MateriasController@index1')->name('sistemaMateria');
Route::get('materiasSearch', 'MateriasController@search')->name('materiasSearch');

Route::post('materiaAdd','MateriasController@materiaAdd');
Route::post('sistemaMateria/materiaAdd','MateriasController@materiaAdd');

Route::post('materiaEdit','MateriasController@materiaEdit');
Route::post('sistemaMateria/materiaEdit','MateriasController@materiaEdit');

Route::post('materiaEstado','MateriasController@materiaEstado');
Route::post('sistemaMateria/materiaEstado','MateriasController@materiaEstado');

Route::post('materia_listaDependientes','MateriasController@materia_listaDependientes');
Route::post('sistemaMateria/materia_listaDependientes','MateriasController@materia_listaDependientes');

Route::post('materia_dependencia','MateriasController@materia_dependencia');
Route::post('sistemaMateria/materia_dependencia','MateriasController@materia_dependencia');

//rutas para userweb
Route::get('userWeb','UserWebController@index')->name('userWeb');
Route::post('userWeb_Facultad','UserWebController@userWeb_Facultad');
Route::post('userWeb_FacultadInsert','UserWebController@userWeb_FacultadInsert');
Route::post('userWeb_Carrera','UserWebController@userWeb_Carrera');
Route::post('userWeb_CarreraInsert','UserWebController@userWeb_CarreraInsert');
Route::post('userWeb_Materia','UserWebController@userWeb_Materia');
Route::post('userWeb_MateriaInsert','UserWebController@userWeb_MateriaInsert');

//rutas para userpublicacion
Route::get('userPublicacion','UserPublicacionController@index')->name('userPublicacion');
Route::post('userPublicacion_Facultad','UserPublicacionController@userPublicacion_Facultad');
Route::post('userPublicacion_FacultadInsert','UserPublicacionController@userPublicacion_FacultadInsert');
Route::post('userPublicacion_Carrera','UserPublicacionController@userPublicacion_Carrera');
Route::post('userPublicacion_CarreraInsert','UserPublicacionController@userPublicacion_CarreraInsert');
Route::post('userPublicacion_Materia','UserPublicacionController@userPublicacion_Materia');
Route::post('userPublicacion_MateriaInsert','UserPublicacionController@userPublicacion_MateriaInsert');
Route::post('userPublicacion_Importancia','UserPublicacionController@userPublicacion_Importancia');
Route::post('userPublicacion_ImportanciaInsert','UserPublicacionController@userPublicacion_ImportanciaInsert');
Route::post('userPublicacion_Tipo','UserPublicacionController@userPublicacion_Tipo');
Route::post('userPublicacion_TipoInsert','UserPublicacionController@userPublicacion_TipoInsert');

//rutas para adminweb
Route::get('adminWeb','AdminWebController@index')->name('adminWeb');
Route::post('adminWeb_listarCarrera','AdminWebController@listarCarrera');
Route::post('adminWeb_listarMateria','AdminWebController@listarMateria');

//rutas para adminwebFacultad
Route::get('adminWebFacultad/{id_facultad}','AdminWebFacultadController@index')->name('adminWebFacultad');
Route::post('adminWebFacultad/adminWebFacultad_edit','AdminWebFacultadController@adminWebFacultad_edit');
Route::post('adminWebFacultad/adminWebFacultad_campos','AdminWebFacultadController@adminWebFacultad_campos');
Route::post('adminWebFacultad/adminWebFacultad_logo','AdminWebFacultadController@adminWebFacultad_logo')->name('adminWebFacultad_logo');
Route::post('adminWebFacultad/adminWebFacultad_carrusel','AdminWebFacultadController@adminWebFacultad_carrusel')->name('adminWebFacultad_carrusel');
Route::post('adminWebFacultad/admimWebFacultad_TipoPublicacionAdd','AdminWebFacultadController@admimWebFacultad_TipoPublicacionAdd');
Route::post('adminWebFacultad/admimWebFacultad_TipoPublicacionEdit','AdminWebFacultadController@admimWebFacultad_TipoPublicacionEdit');
Route::post('adminWebFacultad/admimWebFacultad_TipoPublicacionEstado','AdminWebFacultadController@admimWebFacultad_TipoPublicacionEstado');
Route::post('adminWebFacultad/adminWebFacultad_ListaTipoPublicacion','AdminWebFacultadController@adminWebFacultad_ListaTipoPublicacion');
Route::post('adminWebFacultad/admimWebFacultad_TipoPublicacionPosicion','AdminWebFacultadController@admimWebFacultad_TipoPublicacionPosicion');
Route::post('adminWebFacultad/admimWebFacultad_ImportanciaAdd','AdminWebFacultadController@admimWebFacultad_ImportanciaAdd');
Route::post('adminWebFacultad/admimWebFacultad_ImportanciaEdit','AdminWebFacultadController@admimWebFacultad_ImportanciaEdit');
Route::post('adminWebFacultad/admimWebFacultad_ImportanciaEstado','AdminWebFacultadController@admimWebFacultad_ImportanciaEstado');
Route::post('adminWebFacultad/adminWebFacultad_ListaImportancia','AdminWebFacultadController@adminWebFacultad_ListaImportancia');
Route::post('adminWebFacultad/admimWebFacultad_ImportanciaPosicion','AdminWebFacultadController@admimWebFacultad_ImportanciaPosicion');

//rutas para adminwebCarrera
Route::get('adminWebCarrera/{id_carrera}','AdminWebCarreraController@index')->name('adminWebCarrera');
Route::post('adminWebCarrera/adminWebCarrera_logo','AdminWebCarreraController@adminWebCarrera_logo')->name('adminWebCarrera_logo');
Route::post('adminWebCarrera/adminWebCarrera_carrusel','AdminWebCarreraController@adminWebCarrera_carrusel')->name('adminWebCarrera_carrusel');
Route::post('adminWebCarrera/destroy_file','AdminWebCarreraController@destroy_file');
Route::post('adminWebCarrera/adminWebCarrera_edit','AdminWebCarreraController@adminWebCarrera_edit');
Route::post('adminWebCarrera/adminWebCarrera_campos','AdminWebCarreraController@adminWebCarrera_campos');

//rutas para adminwebMateria
Route::get('adminWebMateria/{id_materia}','AdminWebMateriaController@index')->name('adminWebMateria');
Route::post('adminWebMateria/adminWebMateria_edit','AdminWebMateriaController@adminWebMateria_edit');
Route::post('adminWebMateria/adminWebMateria_campos','AdminWebMateriaController@adminWebMateria_campos');

//rutas para adminpublicaciones
Route::get('adminPublicacion','AdminPublicacionController@index')->name('adminPublicacion');
Route::get('adminPublicacionSearch', 'AdminPublicacionController@search')->name('adminPublicacionSearch');
Route::post('adminPublicacionListaCambiarTipo','AdminPublicacionController@listaCambiarTipo');
Route::post('adminPublicacionUpdateTipo','AdminPublicacionController@updateTipo');
Route::post('adminPublicacionListaCambiarEstado','AdminPublicacionController@listaCambiarEstado');
Route::post('adminPublicacionUpdateEstado','AdminPublicacionController@updateEstado');
Route::post('adminPublicacionListaCambiarImportancia','AdminPublicacionController@listaCambiarImportancia');
Route::post('adminPublicacionUpdateImportancia','AdminPublicacionController@updateImportancia');
Route::post('adminPublicacionUpdateFecha','AdminPublicacionController@updateFecha');
Route::post('adminPublicacionGetFpublicacion','AdminPublicacionController@getFpublicacion');
Route::post('adminPublicacionDestroy','AdminPublicacionController@destroy');
Route::post('adminPublicacion/adminPublicacionGetFpublicacion','AdminPublicacionController@getFpublicacion');
Route::post('adminPublicacionGetFpublicacion','AdminPublicacionController@getFpublicacion');


//rutas para admiPublicacionNew
Route::get('adminPublicacionNew','AdminPublicacionNewController@index')->name('adminPublicacionNew');

Route::post('adminPublicacionNew_listarFacultad','AdminPublicacionNewController@listarFacultad');
Route::post('adminPublicacionNew_listarCarrera','AdminPublicacionNewController@listarCarrera');
Route::post('adminPublicacionNew_listarMateria','AdminPublicacionNewController@listarMateria');
Route::post('adminPublicacionNew_publicacionAdd','AdminPublicacionNewController@publicacionAdd');

//rutas para admiPublicacionEdit
Route::get('adminPublicacionEdit/{id_fpublicacion}','AdminPublicacionEditController@index')->name('adminPublicacionEdit');
Route::post('adminPublicacionEdit/adminPublicacionEdit','AdminPublicacionEditController@publicacionEdit');
Route::post('adminPublicacionEdit','AdminPublicacionEditController@publicacionEdit');
Route::post('adminPublicacionEdit/adminPublicacionEdit_listarFacultad','AdminPublicacionEditController@listarFacultad');
Route::post('adminPublicacionEdit/adminPublicacionEdit_listarCarrera','AdminPublicacionEditController@listarCarrera');
Route::post('adminPublicacionEdit/adminPublicacionEdit_listarMateria','AdminPublicacionEditController@listarMateria');



/*rutas para adminpublicacionFacultad
Route::get('adminPublicacionFacultad/{id_facultad}','AdminPublicacionFacultadController@index')->name('adminPublicacionFacultad');
Route::get('adminPublicacionFacultadSearch', 'AdminPublicacionFacultadController@search')->name('adminPublicacionFacultadSearch');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadDestroy','AdminPublicacionFacultadController@destroy');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadGetFpublicacion','AdminPublicacionFacultadController@getFpublicacion');
Route::post('adminPublicacionFacultadGetFpublicacion','AdminPublicacionFacultadController@getFpublicacion');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadListaCambiarTipo','AdminPublicacionFacultadController@listaCambiarTipo');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadUpdateTipo','AdminPublicacionFacultadController@updateTipo');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadListaCambiarEstado','AdminPublicacionFacultadController@listaCambiarEstado');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadUpdateEstado','AdminPublicacionFacultadController@updateEstado');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadListaCambiarImportancia','AdminPublicacionFacultadController@listaCambiarImportancia');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadUpdateImportancia','AdminPublicacionFacultadController@updateImportancia');
Route::post('adminPublicacionFacultad/adminPublicacionFacultadUpdateFecha','AdminPublicacionFacultadController@updateFecha');

//rutas para adminpublicacionFacultad Nuevo
Route::get('adminPublicacionFacultadNew/{id_facultad}','AdminPublicacionFacultadNewController@index')->name('adminPublicacionFacultadNew');
Route::post('adminPublicacionFacultadNew/publicacionFacultadAdd','AdminPublicacionFacultadNewController@publicacionFacultadAdd');

//rutas para adminpublicacionFacultad Editar
Route::get('adminPublicacionFacultadEdit/{id_fpublicacion}','AdminPublicacionFacultadEditController@index')->name('adminPublicacionFacultadEdit');
Route::post('adminPublicacionFacultadEdit/publicacionFacultadEdit','AdminPublicacionFacultadEditController@publicacionFacultadEdit');*/

//rutas para adminallpublicaciones
Route::get('adminAllPublicacion','AdminAllPublicacionController@index')->name('adminAllPublicacion');
Route::get('adminAllPublicacionSearch', 'AdminAllPublicacionController@search')->name('adminAllPublicacionSearch');
Route::post('adminAllPublicacionGetFpublicacion','AdminAllPublicacionController@getFpublicacion');
Route::post('adminAllPublicacionUpdateEstado','AdminAllPublicacionController@updateEstado');
Route::post('adminAllPublicacionDestroy','AdminAllPublicacionController@destroy');
Route::post('adminAllPublicacionListaCambiarTipo','AdminAllPublicacionController@listaCambiarTipo');
Route::post('adminAllPublicacionUpdateTipo','AdminAllPublicacionController@updateTipo');
Route::post('adminAllPublicacionListaCambiarImportancia','AdminAllPublicacionController@listaCambiarImportancia');
Route::post('adminAllPublicacionUpdateImportancia','AdminAllPublicacionController@updateImportancia');
Route::post('adminAllPublicacionUpdateFecha','AdminAllPublicacionController@updateFecha');

//rutas para adminallpublicacionesFacutlad
Route::get('adminAllPublicacionFacultad/{id_facultad}','AdminAllPublicacionFacultadController@index')->name('adminAllPublicacionFacultad');
Route::get('adminAllPublicacionFacultadSearch', 'AdminAllPublicacionFacultadController@search')->name('adminAllPublicacionFacultadSearch');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadGetFpublicacion','AdminAllPublicacionFacultadController@getFpublicacion');
Route::post('adminAllPublicacionFacultadGetFpublicacion','AdminAllPublicacionFacultadController@getFpublicacion');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadUpdateEstado','AdminAllPublicacionFacultadController@updateEstado');
Route::post('adminAllPublicacionFacultadUpdateEstado','AdminAllPublicacionFacultadController@updateEstado');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadDestroy','AdminAllPublicacionFacultadController@destroy');
Route::post('adminAllPublicacionFacultadDestroy','AdminAllPublicacionFacultadController@destroy');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadListaCambiarTipo','AdminAllPublicacionFacultadController@listaCambiarTipo');
Route::post('adminAllPublicacionFacultadListaCambiarTipo','AdminAllPublicacionFacultadController@listaCambiarTipo');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadUpdateTipo','AdminAllPublicacionFacultadController@updateTipo');
Route::post('adminAllPublicacionFacultadUpdateTipo','AdminAllPublicacionFacultadController@updateTipo');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadUpdateFecha','AdminAllPublicacionFacultadController@updateFecha');
Route::post('adminAllPublicacionFacultadUpdateFecha','AdminAllPublicacionFacultadController@updateFecha');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadListaCambiarImportancia','AdminAllPublicacionFacultadController@listaCambiarImportancia');
Route::post('adminAllPublicacionFacultadListaCambiarImportancia','AdminAllPublicacionFacultadController@listaCambiarImportancia');
Route::post('adminAllPublicacionFacultad/adminAllPublicacionFacultadUpdateImportancia','AdminAllPublicacionFacultadController@updateImportancia');
Route::post('adminAllPublicacionFacultadUpdateImportancia','AdminAllPublicacionFacultadController@updateImportancia');