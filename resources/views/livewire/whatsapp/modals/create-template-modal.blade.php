<div class="modal fade" id="modal_create_template" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalCreateTemplateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px !important;">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTemplateLabel">Create New Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createTemplateForm">
                <div class="modal-body">
                    <!-- Formulario de edición de la plantilla -->
                    <div class="form-group mb-3 all_templates">
                        <!-- Nombre de la Plantilla -->
                        <div class="form-group mb-3">
                            <label for="createTemplateName">Nombre de la Plantilla</label>
                            <input type="text" id="createTemplateName" name="createTemplateName" class="form-control"
                                maxlength="512">
                        </div>

                        <!-- Categoria de la Plantilla -->
                        <div class="form-group mb-3">
                            <label for="createTemplateCategory">Categoria de la plantilla</label>
                            <select class="form-control" name="createTemplateCategory" id="createTemplateCategory">
                                <option value="MARKETING">MARKETING</option>
                                <option value="UTILITY">UTILITY</option>
                                <option value="AUTHENTICATION">AUTHENTICATION</option>
                            </select>
                        </div>

                        <!-- Idioma de la Plantilla -->
                        <div class="form-group mb-3">
                            <label for="createTemplateLanguage">Idioma de la Plantilla</label>
                            <select class="form-control" name="createTemplateLanguage" id="createTemplateLanguage">
                                <option value="af">Afrikáans "af"</option>
                                <option value="sq">Albanés "sq"</option>
                                <option value="ar">Árabe "ar"</option>
                                <option value="az">Azerí "az"</option>
                                <option value="bn">Bengalí "bn"</option>
                                <option value="bg">Búlgaro "bg"</option>
                                <option value="ca">Catalán "ca"</option>
                                <option value="zh_CN">Chino (China) "zh_CN"</option>
                                <option value="zh_HK">Chino (Hong Kong) "zh_HK"</option>
                                <option value="zh_TW">Chino (Tailandia) "zh_TW"</option>
                                <option value="hr">Croata "hr"</option>
                                <option value="cs">Checo "cs"</option>
                                <option value="da">Danés "da"</option>
                                <option value="nl">Holandés "nl"</option>
                                <option value="en">Inglés "en"</option>
                                <option value="en_GB">Inglés (Reino Unido) "en_GB"</option>
                                <option value="en_US">Inglés (EE. UU.) "en_US"</option>
                                <option value="es_LA">Español (Latinoamérica) "es_LA"</option>
                                <option value="et">Estonio "et"</option>
                                <option value="fil">Filipino "fil"</option>
                                <option value="fi">Finlandés "fi"</option>
                                <option value="fr">Francés "fr"</option>
                                <option value="de">Alemán "de"</option>
                                <option value="el">Griego "el"</option>
                                <option value="gu">Guyaratí "gu"</option>
                                <option value="he">Hebreo "he"</option>
                                <option value="hi">Hindi "hi"</option>
                                <option value="hu">Húngaro "hu"</option>
                                <option value="id">Indonesio "id"</option>
                                <option value="ga">Irlandés "ga"</option>
                                <option value="it">Italiano "it"</option>
                                <option value="ja">Japonés "ja"</option>
                                <option value="kn">Canarés "kn"</option>
                                <option value="kk">Kazajo "kk"</option>
                                <option value="ko">Coreano "ko"</option>
                                <option value="lo">Lao "lo"</option>
                                <option value="lv">Letón "lv"</option>
                                <option value="lt">Lituano "lt"</option>
                                <option value="mk">Macedonio "mk"</option>
                                <option value="ms">Malayo "ms"</option>
                                <option value="mr">Maratí "mr"</option>
                                <option value="nb">Noruego "nb"</option>
                                <option value="fa">Persa "fa"</option>
                                <option value="pl">Polaco "pl"</option>
                                <option value="pt_BR">Portugués (Brasil) "pt_BR"</option>
                                <option value="pt_PT">Portugués (Portugal) "pt_PT"</option>
                                <option value="pa">Punyabí "pa"</option>
                                <option value="ro">Rumano "ro"</option>
                                <option value="ru">Ruso "ru"</option>
                                <option value="sr">Serbio "sr"</option>
                                <option value="sk">Eslovaco "sk"</option>
                                <option value="sl">Esloveno "sl"</option>
                                <option value="es">Español "es"</option>
                                <option value="es_AR">Español (Argentina) "es_AR"</option>
                                <option value="es_ES">Español (España) "es_ES"</option>
                                <option value="es_MX">Español (México) "es_MX"</option>
                                <option value="sw">Suajili "sw"</option>
                                <option value="sv">Sueco "sv"</option>
                                <option value="ta">Tamil "ta"</option>
                                <option value="te">Telugu "te"</option>
                                <option value="th">Tailandés "th"</option>
                                <option value="tr">Turco "tr"</option>
                                <option value="uk">Ucraniano "uk"</option>
                                <option value="ur">Urdu "ur"</option>
                                <option value="uz">Uzbeko "uz"</option>
                                <option value="vi">Vietnamita "vi"</option>
                            </select>
                        </div>

                        <!-- Variable de la Plantilla -->
                        <div class="form-group mb-3">
                            <label for="createTemplateVariable">Variables de la plantilla</label>
                            <select class="form-control" name="createTemplateVariable" id="createTemplateVariable">
                                <option value="number">Numero</option>
                                <option value="name">Nombre</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group mb-3 authentication_template">
                        <div class="form-group mb-3">
                            <p><b>Codigo de Acceso de un solo uso</b></p>
                            <p>Envia codigo para verificar una transaccion o un inicio de sesion.</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="createCodeExpiration"><b>Configuración del envío de códigos</b></label>
                            <p>Elige cómo enviarán los clientes el código de WhatsApp a tu app. Las modificaciones de
                                esta sección no requerirán revisión ni tendrán límites de edición. Obtén información
                                sobre cómo enviar plantillas de mensajes de autenticación.</p>
                            <div class="custom-control custom-radio mb-3">
                                <input class="custom-control-input" type="radio" id="autocompletar_sin_toque"
                                    name="config_send_code" value="sin_toque" checked="">
                                <label for="autocompletar_sin_toque" class="custom-control-label">Autocompletar sin
                                    toque</label>
                            </div>

                            <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                <input
                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                    type="checkbox" id="autocompletar_sin_toque_condiciones"
                                    name="autocompletar_sin_toque_condiciones" checked>
                                <label for="autocompletar_sin_toque_condiciones" class="custom-control-label">Al
                                    seleccionar la opción sin toque, entiendo que el uso de la autenticación sin toque
                                    por parte de Script Ateención al cliente está sujeto a las Condiciones del servicio
                                    de WhatsApp Business. Es responsabilidad de Script Ateención al cliente asegurarse
                                    de que los clientes prevean que el código se completará automáticamente si eligen
                                    recibir el código sin toque a través de WhatsApp.</label>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                    Es necesario marcar la casilla para enviar esta plantilla.
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="autocompletar_con_toque"
                                    name="config_send_code" value="con_toque">
                                <label for="autocompletar_con_toque" class="custom-control-label">Autocompletar con un
                                    toque</label>
                                <p>El código se envía a tu app cuando un cliente toca el botón. Cuando no sea posible
                                    autocompletar, se enviará un mensaje para copiar el código.</p>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="copiar_codigo"
                                    name="config_send_code" value="copiar_codigo">
                                <label for="copiar_codigo" class="custom-control-label">Copiar código</label>
                                <p>El contenido de las plantillas de mensajes de autenticación no se puede editar.
                                    Puedes agregar contenido adicional de las siguientes opciones.</p>
                            </div>

                            <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                <input
                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                    type="checkbox" id="recomenracion_seguridad" name="recomenracion_seguridad"
                                    checked="checked">
                                <label for="recomenracion_seguridad" class="custom-control-label">Agregar
                                    recomendación de seguridad.</label>
                            </div>
                            <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                <input
                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                    type="checkbox" id="caducidad_codigo" name="caducidad_codigo">
                                <label for="caducidad_codigo" class="custom-control-label">Agrega la fecha de
                                    caducidad para el código.</label>
                            </div>
                            <div class="" style="margin-left: 50px;">
                                <label for="minutos_caducidad" class="">Minutos_caducidad</label>
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" class="form-control" id="minutos_caducidad"
                                        name="minutos_caducidad" value="1" max="90" min="1">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat">Minutos</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <p><b>Botones</b></p>
                            <p>Puedes personalizar el texto del botón para las opciones de autocompletar y de copiar
                                código. Aunque la opción sin toque esté activada, los botones se necesitan para el
                                método de entrega del código de respaldo.</p>
                        </div>

                        <div class="row form-group mb-3" id="createAutocompleteButtonGroup">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Autocompletar
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="createAutocompleteButton"
                                        name="createAutocompleteButton" value="Autocompletar">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6" id="createCopyCodeButtonGroup">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Copiar codigo
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="createCopyCodeButton"
                                        name="createCopyCodeButton" value="Copiar codigo">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                    </div>

                    <div class="utility_template marketing_template">
                        <!-- Encabezado de la Plantilla -->
                        <div class="form-group mb-3">
                            <label for="createTemplateHeader">Encabezado de la plantilla</label>
                            <select class="form-control" name="createTemplateHeader" id="createTemplateHeader">
                                <option value="ninguno">Ninguno</option>
                                <option value="TEXT">Mensaje de Texto</option>
                                <option value="IMAGE">Imagen</option>
                                <option value="VIDEO">Video</option>
                                <option value="DOCUMENT">Documento</option>
                                <option value="Ubicacion">Ubicacion</option>
                            </select>
                        </div>

                        <!-- Header Text -->
                        <div class="form-group mb-3" id="createHeaderTextGroup">
                            <label for="createHeaderText">Texto del Header</label>
                            <input type="text" id="createHeaderText" name="createHeaderText"
                                class="form-control variable variable-1" maxlength="60">
                            <small class="form-text text-muted">Texto que aparecerá en el encabezado de la plantilla
                                (opcional).</small>
                            <div id="createVariableFields"></div>
                        </div>

                        <div class="row" id="createHeaderImageGroup">
                            <!-- Header Image -->
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="createHeaderImage">Imagen del Header</label>
                                    <input type="file" id="createHeaderImage" name="createHeaderImage"
                                        class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Imagen que aparecerá en el encabezado de la
                                        plantilla
                                        (opcional).</small>
                                </div>
                            </div>
                            <div class="col-6" id="previewImage">
                                <img src="" alt="" class="preview" style="width: 50%">
                            </div>
                        </div>

                        <!-- Header Video -->
                        <div class="form-group mb-3" id="createHeaderVideoGroup">
                            <label for="createHeaderVideo">Video del Header</label>
                            <input type="file" id="createHeaderVideo" name="createHeaderVideo"
                                class="form-control" accept="video/*">
                            <small class="form-text text-muted">Video que aparecerá en el encabezado de la plantilla
                                (opcional).</small>
                        </div>

                        <!-- Header Document -->
                        <div class="form-group mb-3" id="createHeaderDocumentGroup">
                            <label for="createHeaderDocument">Documento del Header</label>
                            <input type="file" id="createHeaderDocument" name="createHeaderDocument"
                                class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <small class="form-text text-muted">Documento que aparecerá en el encabezado de la
                                plantilla
                                (opcional).</small>
                        </div>

                        <!-- Body -->
                        <div class="form-group mb-3">
                            <label for="createBodyText">Texto del Body</label>
                            <textarea id="createBodyText" name="createBodyText" class="form-control variable variable-10" rows="4"
                                maxlength="1024" required></textarea>
                            <small class="form-text text-muted">Texto principal del mensaje. Puedes incluir variables
                                usando
                                @{{ 1 }}, @{{ 2 }}, @{{ order_id }},
                                @{{ mount }} etc.</small>
                        </div>

                        <!-- Footer -->
                        <div class="form-group mb-3">
                            <label for="createFooterText">Texto del Footer</label>
                            <input type="text" id="createFooterText" name="createFooterText"
                                class="form-control variable variable-0" maxlength="60">
                            <small class="form-text text-muted">Texto de pie de página (opcional).</small>
                        </div>

                        <!-- Botones -->
                        <div id="buttonsContainer">
                            <label>Botones</label>
                            <div class="form-group mb-3">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">+ Agregar Boton</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <p><b>Botones de respuesta rápida</b></p>
                                        <a class="dropdown-item" id="create_quick_replay_button"
                                            href="#">Desactivar
                                            marketing <sub>Recomendado</sub></a>
                                        <a class="dropdown-item" id="create_quick_replay_custon_button"
                                            href="#">Personalizado</a>
                                        <div class="dropdown-divider"></div>
                                        <p><b>Botones de llamada a la acción</b></p>
                                        <a class="dropdown-item" id="create_go_to_web_button" href="#">Ir a
                                            sitio web
                                            <sub>2 botones maximo</sub></a>
                                        <a class="dropdown-item" id="create_call_button" href="#">Llamar a
                                            numero de
                                            telefono <sub>1 boton como maximo</sub></a>
                                        <a class="dropdown-item" id="create_copy_code_button" href="#">Copiar
                                            codigo de
                                            oferta <sub>1 boton como maximo</sub></a>
                                    </div>
                                </div>
                            </div>

                            <div class="create_buttons_group">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
