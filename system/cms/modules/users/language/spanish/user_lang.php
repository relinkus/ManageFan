<?php defined('BASEPATH') OR exit('No direct script access allowed');

$lang['user_add_field']                        	= 'Añadir Campo de Perfil de Usuario';
$lang['user_profile_delete_success']           	= 'Campo de Perfil de Usuario eliminado exitosamente';
$lang['user_profile_delete_failure']            = 'Hubo un problema al eliminar su Campo de Perfil de Usuario';
$lang['profile_user_basic_data_label']  		= 'Datos Básicos';
$lang['profile_company']         	  			= 'Compañía';
$lang['profile_updated_on']           			= 'Actualizado';
$lang['user_profile_fields_label']	 		 	= 'Campos de Perfil';

$lang['user_register_header']                  = 'Registro';
$lang['user_register_step1']                   = '<strong>Paso 1:</strong> Register';
$lang['user_register_step2']                   = '<strong>Paso 2:</strong> Activate';

$lang['user_login_header']                     = 'Iniciar Sesión';

// titles
$lang['user_add_title']                        = 'Agregar Usuario';
$lang['user_list_title'] 					   = 'Usuarios';
$lang['user_inactive_title']                   = 'Usuarios Inactivos';
$lang['user_active_title']                     = 'Usuarios Activos';
$lang['user_registred_title']                  = 'Usuarios Registrados';

// labels
$lang['user_edit_title']                       = 'Editar Usuario "%s"';
$lang['user_details_label']                    = 'Detalles';
$lang['user_first_name_label']                 = 'Nombre';
$lang['user_last_name_label']                  = 'Apellido';
$lang['user_email_label']                      = 'E-mail';
$lang['user_group_label']                      = 'Grupo';
$lang['user_password_label']                   = 'Contraseña';
$lang['user_password_confirm_label']           = 'Confirmar Contraseña';
$lang['user_name_label']                       = 'Nombre';
$lang['user_joined_label']                     = 'Registrado';
$lang['user_last_visit_label']                 = 'Última Visita';
$lang['user_never_label']                      = 'Nunca';

$lang['user_no_inactives']                     = 'No hay usuarios inactivos.';
$lang['user_no_registred']                     = 'No hay usuarios registrados.';

$lang['account_changes_saved']                 = 'Los cambios realizados han sido guardados exitosamente.';

$lang['indicates_required']                    = 'Indica los campos requeridos';

// -- Registration / Activation / Reset Password ----------------------------------------------------------

$lang['user_send_activation_email']            = 'Enviar Email de Activación';
$lang['user_do_not_activate']                  = 'Inactivo';
$lang['user_register_title']                   = 'Registrar';
$lang['user_activate_account_title']           = 'Activar Cuenta';
$lang['user_activate_label']                   = 'Activar';
$lang['user_activated_account_title']          = 'Cuenta Activada';
$lang['user_reset_password_title']             = 'Restablecer Contraseña';
$lang['user_password_reset_title']             = 'Restablecer Contraseña';


$lang['user_error_username']                   = 'El nombre de usuario elegido ya está en uso.';
$lang['user_error_email']                      = 'La dirección de Email proporcionada ya está en uso.';

$lang['user_full_name']                        = 'Nombre Completo';
$lang['user_first_name']                       = 'Nombre';
$lang['user_last_name']                        = 'Apellido';
$lang['user_username']                         = 'Nombre de Usuario';
$lang['user_display_name']                     = 'Nombre en Pantalla';
$lang['user_email_use'] 					   = 'usado para el registro';
$lang['user_email']                            = 'E-mail';
$lang['user_confirm_email']                    = 'Confirme E-mail';
$lang['user_password']                         = 'Contraseña';
$lang['user_remember']                         = 'Recordarme';
$lang['user_group_id_label']                   = 'ID de Grupo';

$lang['user_level']                            = 'Rol del Usuario';
$lang['user_active']                           = 'Activo';
$lang['user_lang']                             = 'Idioma';

$lang['user_activation_code']                  = 'Código de Activación';

$lang['user_reset_instructions']			   = 'Ingrese su e-mail o nombre de usuario';
$lang['user_reset_password_link']              = '¿Olvidó su contraseña?';

$lang['user_activation_code_sent_notice']      = 'Un e-mail ha sido enviado a su dirección de correo con el código de activación.';
$lang['user_activation_by_admin_notice']       = 'Su registro está a la espera de la aprobación por parte del administrador.';
$lang['user_registration_disabled']            = 'Disculpe, el registro de usuarios está deshabilitado.';

// -- Settings ---------------------------------------------------------------------------------------------

$lang['user_details_section']                  = 'Nombre';
$lang['user_password_section']                 = 'Cambiar contraseña';
$lang['user_other_settings_section']           = 'Otros ajustes';

$lang['user_settings_saved_success']           = 'Los ajustes de su cuenta de usuario han sido guardados.';
$lang['user_settings_saved_error']             = 'Ha ocurrido un error.';

// -- Buttons ----------------------------------------------------------------------------------------------

$lang['user_register_btn']                     = 'Registrar';
$lang['user_activate_btn']                     = 'Activar';
$lang['user_reset_pass_btn']                   = 'Restablecer Contraseña';
$lang['user_login_btn']                        = 'Iniciar Sesión';
$lang['user_settings_btn']                     = 'Guardar Ajustes';

// -- Errors & Messages ------------------------------------------------------------------------------------

// Create
$lang['user_added_and_activated_success']      = 'Un nuevo usuario ha sido creado y activado.';
$lang['user_added_not_activated_success']      = 'Un nuevo usuario ha sido creado, la cuenta necesita ser activada.';

// Edit
$lang['user_edit_user_not_found_error']        = 'Usuario no encontrado.';
$lang['user_edit_success']                     = 'Usuario actualizado exitosamente.';
$lang['user_edit_error']                       = 'Un error ha ocurrido al tratar de actualizar usuario.';

// Activate
$lang['user_activate_success']                 = '%s usuarios de %s han sido activados exitosamente.';
$lang['user_activate_error']                   = 'Primero necesita seleccionar los usuarios.';

// Delete
$lang['user_delete_self_error']                = '¡Usted no se puede eliminar!';
$lang['user_mass_delete_success']              = '%s usuarios de %s han sido eliminados exitosamente.';
$lang['user_mass_delete_error']                = 'Primero necesita seleccionar los usuarios.';

// Register
$lang['user_email_pass_missing']               = 'Campo de e-mail y/o contraseña están incompletos.';
$lang['user_email_exists']                     = 'La dirección de e-mail que usted ha proporcionado ya se encuentra en uso por otro usuario.';
$lang['user_register_error']				   = 'Creemos que usted es un bot. Si no es así, por favor acepte nuestras disculpas..';
$lang['user_register_reasons']                 = 'Únase para poder tener acceso a áreas especiales normalmente restringidas. Ésto significa que sus ajustes serán recordados, tendrá acceso a más contenido y menos publicidad.';


// Activation
$lang['user_activation_incorrect']             = 'Fallo en la Activación. Por favor chequee sus detos y asegúrese de que CAPS LOCK no esté activado.';
$lang['user_activated_message']                = 'Su cuenta ha sido activada, ahora ya puede ingresar a su cuenta.';


// Login
$lang['user_logged_in']                        = 'Ha iniciado sesión exitosamente.';
$lang['user_already_logged_in']                = 'Usted ya ha iniciado sesión. Por favor cierre la sesión antes de volver a intentarlo.';
$lang['user_login_incorrect']                  = 'Su e-mail y/o contraseña no concuerdan. Por favor chequee y vuelva a intentarlo. Asegúrese de que CAPS LOCK no esté activado.';
$lang['user_inactive']                         = 'La cuenta a la cual usted está intentando acceder se encuentra momentáneamente inactiva.<br />Chequee su casilla de correo para instrucciones de cómo activar su cuenta - <em>puede hallarse en la carpeta de correo no deseado</em>.';


// Logged Out
$lang['user_logged_out']                       = 'Usted ha cerrado la sesión.';

// Forgot Pass
$lang['user_forgot_incorrect']                 = "No se ha encontrado una cuenta correspondiente con estos datos.";

$lang['user_password_reset_message']           = "Su contraseña ha sido restablecida. Usted recibirá un e-mail dentro de las próximas 2 horas. Puede llegar a aparecer como correo no deseado.";


// Emails ----------------------------------------------------------------------------------------------------

// Activation
$lang['user_activation_email_subject']         = 'Se requiere Activación';
$lang['user_activation_email_body']            = 'Gracias por activar su cuenta con %s. Para iniciar sesión en el sitio, por favor visite el siguiente enlace:';


$lang['user_activated_email_subject']          = 'Se ha Completado la Activación';
$lang['user_activated_email_content_line1']    = 'Gracias por registrarte en %s. Antes de que podamos activar su cuenta, por favor complete el proceso de registro haciendo click sobre el siguiente link:';
$lang['user_activated_email_content_line2']    = 'En caso de que su programa de correo electrónico no reconozca el link anterior, mediante su explorador diríjase a la siguiente URL e ingrese el código de activación:';

// Reset Pass
$lang['user_reset_pass_email_subject']         = 'Restablecer Contraseña';
$lang['user_reset_pass_email_body']            = 'Su contraseña en %s ha sido restablecida. Si usted no ha solicitado este cambio, por favor envíenos un e-mail a %s y nosotros nos encargaremos de resolver la situacón.';

// Profile
$lang['profile_of_title']             = '%s\'s Perfil';

$lang['profile_user_details_label']   = 'Datos del Usuario';
$lang['profile_role_label']           = 'Rol';
$lang['profile_registred_on_label']   = 'Registrado en';
$lang['profile_last_login_label']     = 'Último acceso';
$lang['profile_male_label']           = 'Masculino';
$lang['profile_female_label']         = 'Femenino';
$lang['user_profile_fields_label']	  = 'Campos de Perfil';

$lang['profile_not_set_up']           = 'Este usuario no tiene un perfil establecido.';

$lang['profile_edit']                 = 'Editar perfil';

$lang['profile_personal_section']     = 'Personal';

$lang['profile_display_name']         = 'Nombre en Pantalla';
$lang['profile_dob']                  = 'Fecha de Nacimiento';
$lang['profile_dob_day']              = 'Día';
$lang['profile_dob_month']            = 'Mes';
$lang['profile_dob_year']             = 'Año';
$lang['profile_gender']               = 'Sexo';
$lang['profile_gender_nt']            = 'No especifica';
$lang['profile_gender_male']          = 'Masculino';
$lang['profile_gender_female']        = 'Femenino';
$lang['profile_bio']                  = 'Sobre Mí';

$lang['profile_contact_section']      = 'Contacto';

$lang['profile_phone']                = 'Teléfono';
$lang['profile_mobile']               = 'Móvil';
$lang['profile_address']              = 'Dirección';
$lang['profile_address_line1']        = 'Línea #1';
$lang['profile_address_line2']        = 'Línea #2';
$lang['profile_address_line3']        = 'Ciudad';
$lang['profile_address_postcode']     = 'Código Postal';
$lang['profile_website']              = 'Website';

$lang['profile_api_section']     	  = 'Acceso a API';

$lang['profile_edit_success']         = 'Su perfil ha sido guardado.';
$lang['profile_edit_error']           = 'Ha ocurrido un error.';

// -- Buttons ------------------------------------------------------------------------------------------------

$lang['profile_save_btn']             = 'Guardar perfil';
/* End of file user_lang.php */