<div class="modal fade" id="modal_edit_template" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalEditTemplateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px !important;">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTemplateLabel">Edit Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTemplateForm">
                <div class="modal-body">
                    <!-- Formulario de edición de la plantilla -->
                    <!-- Nombre de la Plantilla -->
                    <div class="form-group mb-3">
                        <label for="editTemplateName">Nombre de la Plantilla</label>
                        <input type="text" id="editTemplateName" name="editTemplateName" class="form-control"
                            maxlength="512" readonly>
                        <input type="hidden" id="editTemplateId" name="editTemplateId">
                        <input type="hidden" id="editTemplateWabaId" name="editTemplateWabaId">
                        <input type="hidden" id="editCategory" name="editCategory">
                    </div>

                    <!-- Idioma de la Plantilla -->
                    <div class="form-group mb-3">
                        <label for="editTemplateLanguage">Idioma de la Plantilla</label>
                        <select class="form-control" name="editTemplateLanguage" id="editTemplateLanguage">
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
                            <option value="es_MX" selected>Español (México) "es_MX"</option>
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
                        <label for="editTemplateVariable">Variables de la plantilla</label>
                        <select class="form-control" name="editTemplateVariable" id="editTemplateVariable">
                            <option value="number">Numero</option>
                            <option value="name">Nombre</option>
                        </select>
                    </div>

                    <!-- Encabezado de la Plantilla -->
                    <div class="form-group mb-3">
                        <label for="editTemplateHeader">Encabezado de la plantilla</label>
                        <select class="form-control" name="editTemplateHeader" id="editTemplateHeader">
                            <option value="ninguno">Ninguno</option>
                            <option value="TEXT">Mensaje de Texto</option>
                            <option value="IMAGE">Imagen</option>
                            <option value="VIDEO">Video</option>
                            <option value="DOCUMENT">Documento</option>
                            <option value="Ubicacion">Ubicacion</option>
                        </select>
                    </div>

                    <!-- Header Text -->
                    <div class="form-group mb-3" id="headerTextGroup">
                        <label for="editHeaderText">Texto del Header</label>
                        <input type="text" id="editHeaderText" name="editHeaderText" class="form-control variable variable-1"
                            maxlength="60">
                        <small class="form-text text-muted">Texto que aparecerá en el encabezado de la plantilla
                            (opcional).</small>
                        <div id="variableFields"></div>
                    </div>

                    <div class="row" id="headerImageGroup">
                        <!-- Header Image -->
                        <div class="col-6">
                            <div class="form-group mb-3" >
                                <label for="editHeaderImage">Imagen del Header</label>
                                <input type="file" id="editHeaderImage" name="editHeaderImage" class="form-control"
                                    accept="image/*">
                                <small class="form-text text-muted">Imagen que aparecerá en el encabezado de la plantilla
                                    (opcional).</small>
                            </div>
                        </div>
                        <div class="col-6" id="previewImage">
                            <img src="" alt="" class="preview" style="width: 50%">
                        </div>
                    </div>


                    <!-- Header Video -->
                    <div class="form-group mb-3" id="headerVideoGroup">
                        <label for="editHeaderVideo">Video del Header</label>
                        <input type="file" id="editHeaderVideo" name="editHeaderVideo" class="form-control"
                            accept="video/*">
                        <small class="form-text text-muted">Video que aparecerá en el encabezado de la plantilla
                            (opcional).</small>
                    </div>

                    <!-- Header Document -->
                    <div class="form-group mb-3" id="headerDocumentGroup">
                        <label for="editHeaderDocument">Documento del Header</label>
                        <input type="file" id="editHeaderDocument" name="editHeaderDocument" class="form-control"
                            accept=".pdf,.doc,.docx,.xls,.xlsx">
                        <small class="form-text text-muted">Documento que aparecerá en el encabezado de la plantilla
                            (opcional).</small>
                    </div>

                    <!-- Body -->
                    <div class="form-group mb-3">
                        <label for="editBodyText">Texto del Body</label>
                        <textarea id="editBodyText" name="editBodyText" class="form-control variable variable-10" rows="4" maxlength="1024" required></textarea>
                        <small class="form-text text-muted">Texto principal del mensaje. Puedes incluir variables
                            usando
                            @{{ 1 }}, @{{ 2 }}, @{{ order_id }},
                            @{{ mount }} etc.</small>
                    </div>

                    <!-- Footer -->
                    <div class="form-group mb-3">
                        <label for="editFooterText">Texto del Footer</label>
                        <input type="text" id="editFooterText" name="editFooterText" class="form-control variable variable-0"
                            maxlength="60">
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
                                    <a class="dropdown-item" id="quick_replay_button" href="#">Desactivar
                                        marketing <sub>Recomendado</sub></a>
                                    <a class="dropdown-item" id="quick_replay_custon_button"
                                        href="#">Personalizado</a>
                                    <div class="dropdown-divider"></div>
                                    <p><b>Botones de llamada a la acción</b></p>
                                    <a class="dropdown-item" id="go_to_web_button" href="#">Ir a sitio web
                                        <sub>2 botones
                                            maximo</sub></a>
                                    <a class="dropdown-item" id="call_button" href="#">Llamar a numero de
                                        telefono <sub>1
                                            boton como maximo</sub></a>
                                    <a class="dropdown-item" id="copy_code_button" href="#">Copiar codigo de
                                        oferta <sub>1 boton
                                            como maximo</sub></a>
                                </div>
                            </div>
                        </div>

                        <div class="buttons_group">

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
