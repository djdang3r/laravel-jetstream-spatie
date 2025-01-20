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
                            <option value="es">Español "es"</option>
                            <option value="en_US">Ingles "en_US"</option>
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

                    <!-- Encabezado de la Plantilla -->
                    <div class="form-group mb-3 auth-template">
                        <label for="createSecurityRecommendation">Recomendacion de Seguridad</label>
                        <select class="form-control" name="createSecurityRecommendation" id="createSecurityRecommendation">
                            <option value="false">No</option>
                            <option value="true" selected>Si</option>
                        </select>
                    </div>

                    <!-- Encabezado de la Plantilla -->
                    <div class="form-group mb-3 auth-template">
                        <label for="createCodeExpiration">Recomendacion de Seguridad</label>
                        <select class="form-control" name="createCodeExpiration" id="createCodeExpiration">
                            <option value="false">No</option>
                            <option value="true" selected>Si</option>
                        </select>
                    </div>

                    <!-- Encabezado de la Plantilla -->
                    <div class="form-group mb-3">
                        <label for="createTemplateHeader">Encabezado de la plantilla</label>
                        <input type="number" id="createTemplateHeader" name="createTemplateHeader"
                            class="form-control variable variable-1" min="0" max="60" step="1">
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
                        <input type="file" id="createHeaderVideo" name="createHeaderVideo" class="form-control"
                            accept="video/*">
                        <small class="form-text text-muted">Video que aparecerá en el encabezado de la plantilla
                            (opcional).</small>
                    </div>

                    <!-- Header Document -->
                    <div class="form-group mb-3" id="createHeaderDocumentGroup">
                        <label for="createHeaderDocument">Documento del Header</label>
                        <input type="file" id="createHeaderDocument" name="createHeaderDocument"
                            class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                        <small class="form-text text-muted">Documento que aparecerá en el encabezado de la plantilla
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
                                    <a class="dropdown-item" id="create_quick_replay_button" href="#">Desactivar
                                        marketing <sub>Recomendado</sub></a>
                                    <a class="dropdown-item" id="create_quick_replay_custon_button"
                                        href="#">Personalizado</a>
                                    <div class="dropdown-divider"></div>
                                    <p><b>Botones de llamada a la acción</b></p>
                                    <a class="dropdown-item" id="create_go_to_web_button" href="#">Ir a sitio web
                                        <sub>2 botones maximo</sub></a>
                                    <a class="dropdown-item" id="create_call_button" href="#">Llamar a numero de
                                        telefono <sub>1 boton como maximo</sub></a>
                                    <a class="dropdown-item" id="create_copy_code_button" href="#">Copiar codigo de
                                        oferta <sub>1 boton como maximo</sub></a>
                                </div>
                            </div>
                        </div>

                        <div class="create_buttons_group">

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
