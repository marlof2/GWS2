<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Visualização de Pessoa Física</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 elevation-0 my-2">
      <v-row>
        <ShowData
          :cols="10"
          :label="'Nome Completo'"
          :data="form.nome_completo"
        />
        <v-col class="d-flex align-center" cols="2" md="2" lg="2" xl="2">
          <router-link :to="`/pessoafisicas/editar/${$route.params.id}`">
            <v-btn outlined color="#5abf7a">
              Editar <v-icon>mdi-chevron-double-right</v-icon>
            </v-btn>
          </router-link>
        </v-col>
      </v-row>

      <v-row>
        <ShowData :cols="6" :label="'Nome Social'" :data="form.nome_social" />
        <ShowData
          :cols="6"
          :label="'Primeiro Nome/Apelido'"
          :data="form.apelido"
        />
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Data de Nascimento'"
          :data="form.data_nascimento"
          isData
        />
        <ShowData :cols="6" :label="'Sexo'" :data="form.sexo.descricao" />
      </v-row>

      <v-row>
        <ShowData :cols="6" :label="'Nome do Pai'" :data="form.nome_pai" />
        <ShowData
          :cols="6"
          :label="'Pai Desconhecido?'"
          :data="form.eh_pai_desconhecido"
        />
      </v-row>

      <v-row>
        <ShowData :cols="6" :label="'Nome da Mãe'" :data="form.nome_mae" />
        <ShowData
          :cols="6"
          :label="'Mãe Desconhecida?'"
          :data="form.eh_mae_desconhecida"
        />
      </v-row>

      <v-row>
        <ShowData :cols="4" :label="'É Falecido?'" :data="form.eh_falecido" />
        <ShowData
          :cols="4"
          :label="'Data de Falecimento'"
          :data="form.data_falecimento"
          isData
        />
        <ShowData
          :cols="4"
          :label="'Declaração de Óbito'"
          :data="form.declaracao_obito"
        />
      </v-row>

      <v-row>
        <ShowData :cols="6" :label="'Raça'" :data="form.raca.descricao" />
        <ShowData :cols="6" :label="'Etnia'" :data="form.etnia.descricao" />
      </v-row>

      <v-row>
        <ShowData
          :cols="3"
          :label="'Tipo de Nacionalidade'"
          :data="form.tipo_nacionalidade"
        />
        <v-col cols="9" sm="9" md="9"> </v-col>
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Naturalidade'"
          :data="form.municipio.nome"
        />
        <v-col cols="6" sm="6" md="6"> </v-col>
      </v-row>

      <v-row>
        <ShowData :cols="6" :label="'Nacionalidade'" :data="form.pais.nome" />
        <ShowData
          :cols="6"
          :label="'Data da Última Entrada no Brasil'"
          :data="form.data_ultima_entrada_estrangeiro"
          isData
        />
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Data de Naturalização'"
          :data="form.data_naturalizacao"
          isData
        />
        <ShowData
          :cols="6"
          :label="'Portaria de Naturalização'"
          :data="form.portaria_naturalizacao"
        />
      </v-row>

      <v-row>
        <ShowData
          :cols="12"
          :label="'Ocupação'"
          :data="form.ocupacao.descricao"
        />
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Estado Civil'"
          :data="form.estado_civil.descricao"
        />
        <v-col cols="6" sm="6" md="6"> </v-col>
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Deseja informar identidade de gênero'"
          :data="form.informa_identidade_genero"
        />
        <ShowData
          :cols="6"
          :label="'Identidade de Gênero'"
          :data="form.identidade_genero.descricao"
        />
      </v-row>

      <v-row>
        <ShowData
          :cols="6"
          :label="'Deseja informar orientação sexual'"
          :data="form.informa_orientacao_sexual"
        />
        <ShowData
          :cols="6"
          :label="'Orientação Sexual'"
          :data="form.orientacao_sexual.descricao"
        />
      </v-row>
    </v-card>

    <v-card class="elevation-0">
      <v-row class="pa-2">
        <v-col cols="12" sm="12" md="12">
          <DataTableInsider
            :headers="tblPessoaFisicaDocumento.headers"
            :items="form.pessoa_fisica_documento"
            @onClickEdit="editPessoaFisicaDocumento"
            @onClickDelete="deletePessoaFisicaDocumentoDialog"
          >
            <template v-slot:top>
              <HeaderDataTableInsider
                :title="'PF Documento'"
                :addButtonClick="() => (tblPessoaFisicaDocumento.dialog = true)"
              />
              <Dialog
                v-model="tblPessoaFisicaDocumento.dialog"
                :maxWidth="600"
                :title="'PF Documento'"
                :saveClick="savePessoaFisicaDocumento"
                :closeClick="closePessoaFisicaDocumento"
              >
                <v-form
                  ref="formPessoaFisicaDocumento"
                  v-model="validPessoaFisicaDocumento"
                  lazy-validation
                >
                  <v-row>
                    <v-col cols="6" sm="6" md="6">
                      <Select
                        v-model="tblPessoaFisicaDocumento.tipo_documento_id"
                        :itemValue="'id'"
                        :itemText="'descricao'"
                        :items="form.tipo_documento"
                        :label="'Tipo de Documento'"
                        :rules="required"
                        required
                      />
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col cols="3" sm="3" md="3">
                      <TextField
                        v-model="tblPessoaFisicaDocumento.inscricao"
                        label="Inscrição"
                        :maxlength="30"
                        v-mask="''"
                        :rules="required"
                        required
                      />
                    </v-col>
                    <v-col cols="9" sm="9" md="9"> </v-col>
                  </v-row>

                  <v-row>
                    <v-col cols="3" sm="3" md="3">
                      <TextField
                        v-model="tblPessoaFisicaDocumento.complemento"
                        label="Complemento"
                        :maxlength="1000"
                        v-mask="''"
                        :rules="required"
                        required
                      />
                    </v-col>
                    <v-col cols="9" sm="9" md="9"> </v-col>
                  </v-row>
                </v-form>
              </Dialog>
            </template>
          </DataTableInsider>
          <Dialog
            v-model="tblPessoaFisicaDocumento.dialogDelete"
            :maxWidth="600"
            :title="'PF Documento'"
            :closeClick="closeDeletePessoaFisicaDocumento"
            :deleteClick="deletePessoaFisicaDocumentoConfirm"
            :isDelete="true"
          >
            <h3>Tem certeza que deseja excluir este PF Documento?</h3>
          </Dialog>
        </v-col>
      </v-row>
    </v-card>
    <v-card class="my-2 elevation-0">
      <v-row class="my-2 pa-2">
        <v-col cols="12" sm="12" md="12">
          <v-data-table
            :headers="tblPessoaFisicaEndereco.headers"
            :items="form.pessoa_fisica_endereco"
            hide-default-footer
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title><strong>Endereços</strong></v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog
                  persistent
                  v-model="tblPessoaFisicaEndereco.dialog"
                  max-width="80vw"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <AddButtonIcon :vBind="attrs" :on="on" />
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">Endereço</span>
                    </v-card-title>

                    <v-container>
                      <v-form
                        ref="formPessoaFisicaEndereco"
                        v-model="validPessoaFisicaEndereco"
                        lazy-validation
                      >
                        <v-row>
                          <v-col cols="6" sm="6" md="6">
                            <Select
                              v-model="tblPessoaFisicaEndereco.tipo_endereco_id"
                              :itemValue="'id'"
                              :itemText="'descricao'"
                              :items="form.tipo_endereco"
                              :label="'Tipo de Endereço'"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="3" sm="3" md="3">
                            <SwitchButton
                              v-model="tblPessoaFisicaEndereco.eh_principal"
                              :label="'É Principal?'"
                            />
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="3" sm="3" md="3">
                            <TextField
                              v-model="tblPessoaFisicaEndereco.endereco.cep"
                              label="CEP"
                              :maxlength="9"
                              v-mask="''"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="9" sm="9" md="9"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="4" sm="4" md="4">
                            <Select
                              v-model="
                                tblPessoaFisicaEndereco.endereco
                                  .tipo_logradouro_id
                              "
                              :itemValue="'id'"
                              :itemText="'descricao'"
                              :items="form.tipo_logradouro"
                              :label="'Tipo de Logradouro'"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="4" sm="4" md="4">
                            <TextField
                              v-model="
                                tblPessoaFisicaEndereco.endereco.logradouro
                              "
                              label="Logradouro"
                              :maxlength="300"
                              v-mask="''"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="4" sm="4" md="4">
                            <TextField
                              v-model="tblPessoaFisicaEndereco.endereco.numero"
                              label="Número"
                              v-mask="''"
                              :maxlength="20"
                            />
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="6" sm="6" md="6">
                            <TextField
                              v-model="tblPessoaFisicaEndereco.endereco.bairro"
                              label="Bairro"
                              v-mask="''"
                              :maxlength="80"
                            />
                          </v-col>
                          <v-col cols="6" sm="6" md="6"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="9" sm="9" md="9">
                            <TextField
                              v-model="
                                tblPessoaFisicaEndereco.endereco.complemento
                              "
                              label="Complemento"
                              v-mask="''"
                              :maxlength="100"
                            />
                          </v-col>
                          <v-col cols="3" sm="3" md="3"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="9" sm="9" md="9">
                            <TextField
                              v-model="
                                tblPessoaFisicaEndereco.endereco
                                  .ponto_referencia
                              "
                              label="Ponto de Referência"
                              v-mask="''"
                              :maxlength="120"
                            />
                          </v-col>
                          <v-col cols="3" sm="3" md="3"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="6" sm="6" md="6">
                            <SelectAutocomplete
                              :items="getMunicipio.data"
                              :itemValue="'id'"
                              :itemText="'nome'"
                              :label="'Município'"
                              :rules="required"
                              required
                              v-model="
                                tblPessoaFisicaEndereco.endereco.municipio_id
                              "
                            />
                          </v-col>
                          <v-col cols="6" sm="6" md="6">
                            <SwitchButton
                              v-model="
                                tblPessoaFisicaEndereco.endereco
                                  .eh_endereco_brasil
                              "
                              :label="'Endereço no Brasil?'"
                            />
                          </v-col>
                        </v-row>
                      </v-form>
                    </v-container>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closePessoaFisicaEndereco"
                      >
                        Cancelar
                      </v-btn>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="savePessoaFisicaEndereco"
                      >
                        Salvar
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <v-dialog
                  v-model="tblPessoaFisicaEndereco.dialogDelete"
                  max-width="580px"
                >
                  <v-card>
                    <v-card-title class="text-h5 text-wrap"
                      >Tem certeza que deseja excluir este
                      Endereço?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closeDeletePessoaFisicaEndereco"
                        >Cancelar</v-btn
                      >
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="deletePessoaFisicaEnderecoConfirm"
                        >Excluir</v-btn
                      >
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon
                color="#5abf7a"
                class="mr-2"
                @click="editPessoaFisicaEndereco(item)"
                size="26"
              >
                mdi-pencil-circle-outline
              </v-icon>
              <v-icon
                color="#be5b59"
                @click="deletePessoaFisicaEnderecoDialog(item)"
                size="26"
              >
                mdi-trash-can-outline
              </v-icon>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card>
    <v-card class="my-2 elevation-0">
      <v-row class="my-2 pa-2">
        <v-col cols="12" sm="12" md="12">
          <v-data-table
            :headers="tblPessoaFisicaEmail.headers"
            :items="form.pessoa_fisica_email"
            hide-default-footer
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title><strong>PF E-mail</strong></v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog
                  persistent
                  v-model="tblPessoaFisicaEmail.dialog"
                  max-width="580px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <AddButtonIcon :vBind="attrs" :on="on" />
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">PF E-mail</span>
                    </v-card-title>

                    <v-container>
                      <v-form
                        ref="formPessoaFisicaEmail"
                        v-model="validPessoaFisicaEmail"
                        lazy-validation
                      >
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <TextField
                              v-model="tblPessoaFisicaEmail.email"
                              label="E-mail"
                              :maxlength="320"
                              v-mask="''"
                              :rules="required"
                              required
                            />
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="3" sm="3" md="3">
                            <SwitchButton
                              v-model="tblPessoaFisicaEmail.eh_principal"
                              :label="'É Principal?'"
                            />
                          </v-col>
                          <v-col cols="9" sm="9" md="9"> </v-col>
                        </v-row>
                      </v-form>
                    </v-container>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closePessoaFisicaEmail"
                      >
                        Cancelar
                      </v-btn>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="savePessoaFisicaEmail"
                      >
                        Salvar
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <v-dialog
                  v-model="tblPessoaFisicaEmail.dialogDelete"
                  max-width="580px"
                >
                  <v-card>
                    <v-card-title class="text-h5 text-wrap"
                      >Tem certeza que deseja excluir este PF
                      E-mail?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closeDeletePessoaFisicaEmail"
                        >Cancelar</v-btn
                      >
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="deletePessoaFisicaEmailConfirm"
                        >Excluir</v-btn
                      >
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon
                color="#5abf7a"
                class="mr-2"
                @click="editPessoaFisicaEmail(item)"
                size="26"
              >
                mdi-pencil-circle-outline
              </v-icon>
              <v-icon
                color="#be5b59"
                @click="deletePessoaFisicaEmailDialog(item)"
                size="26"
              >
                mdi-trash-can-outline
              </v-icon>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card>
    <v-card class="my-2 elevation-0">
      <v-row class="my-2 pa-2">
        <v-col cols="12" sm="12" md="12">
          <v-data-table
            :headers="tblPessoaFisicaMeioComunicacao.headers"
            :items="form.pessoa_fisica_meio_comunicacao"
            hide-default-footer
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title
                  ><strong>PF Meio de Comunicação</strong></v-toolbar-title
                >
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog
                  persistent
                  v-model="tblPessoaFisicaMeioComunicacao.dialog"
                  max-width="580px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <AddButtonIcon :vBind="attrs" :on="on" />
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">PF Meio de Comunicação</span>
                    </v-card-title>

                    <v-container>
                      <v-form
                        ref="formPessoaFisicaMeioComunicacao"
                        v-model="validPessoaFisicaMeioComunicacao"
                        lazy-validation
                      >
                        <v-row>
                          <v-col cols="3" sm="3" md="3">
                            <Select
                              v-model="
                                tblPessoaFisicaMeioComunicacao.meio_comunicacao_id
                              "
                              :itemValue="'id'"
                              :itemText="'descricao'"
                              :items="form.meio_comunicacao"
                              :label="'Meio de Comunicação'"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="9" sm="9" md="9"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="9" sm="9" md="9">
                            <TextField
                              v-model="tblPessoaFisicaMeioComunicacao.descricao"
                              label="Descrição"
                              :maxlength="100"
                              v-mask="''"
                              :rules="required"
                              required
                            />
                          </v-col>
                          <v-col cols="3" sm="3" md="3"> </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="6" sm="6" md="6">
                            <SwitchButton
                              v-model="
                                tblPessoaFisicaMeioComunicacao.eh_principal
                              "
                              :label="'É Principal?'"
                            />
                          </v-col>
                          <v-col cols="6" sm="6" md="6">
                            <SwitchButton
                              v-model="
                                tblPessoaFisicaMeioComunicacao.eh_whatsapp
                              "
                              :label="'É WhatsApp?'"
                            />
                          </v-col>
                        </v-row>
                      </v-form>
                    </v-container>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closePessoaFisicaMeioComunicacao"
                      >
                        Cancelar
                      </v-btn>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="savePessoaFisicaMeioComunicacao"
                      >
                        Salvar
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <v-dialog
                  v-model="tblPessoaFisicaMeioComunicacao.dialogDelete"
                  max-width="580px"
                >
                  <v-card>
                    <v-card-title class="text-h5 text-wrap"
                      >Tem certeza que deseja excluir este PF Meio de
                      Comunicação?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="closeDeletePessoaFisicaMeioComunicacao"
                        >Cancelar</v-btn
                      >
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="deletePessoaFisicaMeioComunicacaoConfirm"
                        >Excluir</v-btn
                      >
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon
                color="#5abf7a"
                class="mr-2"
                @click="editPessoaFisicaMeioComunicacao(item)"
                size="26"
              >
                mdi-pencil-circle-outline
              </v-icon>
              <v-icon
                color="#be5b59"
                @click="deletePessoaFisicaMeioComunicacaoDialog(item)"
                size="26"
              >
                mdi-trash-can-outline
              </v-icon>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card>
    <v-card-actions>
      <v-spacer></v-spacer>
      <FormButton
        :background="this.$colors.btn_voltar"
        :label="this.$strings.btn_fechar"
        dark
        @click="$router.go(-1)"
      />
    </v-card-actions>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import { constants } from "../_constants";
import FormButton from "../../../components/UI/FormButton.vue";
import TextField from "../../../components/Inputs/TextField.vue";
import SwitchButton from "../../../components/Inputs/SwitchButton.vue";
import Select from "../../../components/Inputs/Select.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import ShowData from "../../../components/UI/ShowData.vue";
import AddButton from "../../../components/UI/AddButton.vue";
import AddButtonIcon from "../../../components/UI/AddButonIcon.vue";
import SelectAutocomplete from "../../../components/Inputs/SelectAutocomplete.vue";
import Dialog from "../../../components/UI/Dialog.vue";
import DataTableInsider from "../../../components/UI/DataTableInsider.vue";
import HeaderDataTableInsider from "../../../components/UI/HeaderDataTableInsider.vue";

export default {
  name: "pessoaFisicaForm",
  components: {
    FormButton,
    Breadcrumbs,
    Select,
    TextField,
    ShowData,
    SwitchButton,
    AddButtonIcon,
    AddButton,
    SelectAutocomplete,
    Dialog,
    DataTableInsider,
    HeaderDataTableInsider,
  },
  beforeCreate() {
    const STORE_PESSOA_FISICA = "$_pessoaFisica";
    if (!(STORE_PESSOA_FISICA in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PESSOA_FISICA, store);
  },
  data() {
    return {
      validPessoaFisicaEmail: true,
      validPessoaFisicaDocumento: true,
      validPessoaFisicaEndereco: true,
      validPessoaFisicaMeioComunicacao: true,
      required: [(v) => !!v || "Campo obrigatório"],
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsShow],
      tblPessoaFisicaEmail: { ...constants.tblPessoaFisicaEmail },
      tblPessoaFisicaDocumento: { ...constants.tblPessoaFisicaDocumento },
      tblPessoaFisicaEndereco: { ...constants.tblPessoaFisicaEndereco },
      tblPessoaFisicaMeioComunicacao: {
        ...constants.tblPessoaFisicaMeioComunicacao,
      },
    };
  },
  async mounted() {
    await this.itemById(this.$route.params.id);
    await this.tipoLogradouro({ limit: -1 });
    await this.municipio({ limit: -1 });
    await this.tipoEndereco({ limit: -1 });
    await this.meioComunicacao({ limit: -1 });
    await this.tipoDocumento({ limit: -1 });
  },
  computed: {
    ...mapGetters({
      getItemById: "$_pessoaFisica/getItemById",
      getPessoaFisicaEmailById: "$_pessoaFisica/getPessoaFisicaEmailById",
      getPessoaFisicaDocumentoById:
        "$_pessoaFisica/getPessoaFisicaDocumentoById",
      getPessoaFisicaEnderecoById: "$_pessoaFisica/getPessoaFisicaEnderecoById",
      getPessoaFisicaMeioComunicacaoById:
        "$_pessoaFisica/getPessoaFisicaMeioComunicacaoById",
      getTipoLogradouro: "$_pessoaFisica/getTipoLogradouro",
      getMunicipio: "$_pessoaFisica/getMunicipio",
      getTipoEndereco: "$_pessoaFisica/getTipoEndereco",
      getMeioComunicacao: "$_pessoaFisica/getMeioComunicacao",
      getTipoDocumento: "$_pessoaFisica/getTipoDocumento",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_pessoaFisica/getItemById",
      createPessoaFisicaEmail: "$_pessoaFisica/createPessoaFisicaEmail",
      updatePessoaFisicaEmail: "$_pessoaFisica/updatePessoaFisicaEmail",
      deletePessoaFisicaEmail: "$_pessoaFisica/deletePessoaFisicaEmail",
      pessoaFisicaEmailById: "$_pessoaFisica/getPessoaFisicaEmailById",
      createPessoaFisicaDocumento: "$_pessoaFisica/createPessoaFisicaDocumento",
      updatePessoaFisicaDocumento: "$_pessoaFisica/updatePessoaFisicaDocumento",
      deletePessoaFisicaDocumento: "$_pessoaFisica/deletePessoaFisicaDocumento",
      pessoaFisicaDocumentoById: "$_pessoaFisica/getPessoaFisicaDocumentoById",
      createPessoaFisicaEndereco: "$_pessoaFisica/createPessoaFisicaEndereco",
      updatePessoaFisicaEndereco: "$_pessoaFisica/updatePessoaFisicaEndereco",
      deletePessoaFisicaEndereco: "$_pessoaFisica/deletePessoaFisicaEndereco",
      pessoaFisicaEnderecoById: "$_pessoaFisica/getPessoaFisicaEnderecoById",
      createPessoaFisicaMeioComunicacao:
        "$_pessoaFisica/createPessoaFisicaMeioComunicacao",
      updatePessoaFisicaMeioComunicacao:
        "$_pessoaFisica/updatePessoaFisicaMeioComunicacao",
      deletePessoaFisicaMeioComunicacao:
        "$_pessoaFisica/deletePessoaFisicaMeioComunicacao",
      pessoaFisicaMeioComunicacaoById:
        "$_pessoaFisica/getPessoaFisicaMeioComunicacaoById",
      tipoLogradouro: "$_pessoaFisica/getTipoLogradouro",
      municipio: "$_pessoaFisica/getMunicipio",
      tipoEndereco: "$_pessoaFisica/getTipoEndereco",
      meioComunicacao: "$_pessoaFisica/getMeioComunicacao",
      tipoDocumento: "$_pessoaFisica/getTipoDocumento",
    }),
    async editPessoaFisicaDocumento(item) {
      await this.pessoaFisicaDocumentoById(item.id);

      this.tblPessoaFisicaDocumento.editedIndex =
        this.form.pessoa_fisica_documento.indexOf(item);
      this.tblPessoaFisicaDocumento.dialog = true;
    },
    deletePessoaFisicaDocumentoDialog(item) {
      this.tblPessoaFisicaDocumento.editedIndex =
        this.form.pessoa_fisica_documento.indexOf(item);
      this.tblPessoaFisicaDocumento.dialogDelete = true;
    },
    resetPessoaFisicaEmail() {
      this.tblPessoaFisicaEmail = { ...constants.tblPessoaFisicaEmail };
    },

    resetPessoaFisicaDocumento() {
      this.tblPessoaFisicaDocumento = { ...constants.tblPessoaFisicaDocumento };
    },

    resetPessoaFisicaEndereco() {
      this.tblPessoaFisicaEndereco = { ...constants.tblPessoaFisicaEndereco };
    },

    resetPessoaFisicaMeioComunicacao() {
      this.tblPessoaFisicaMeioComunicacao = {
        ...constants.tblPessoaFisicaMeioComunicacao,
      };
    },

    async savePessoaFisicaEmail() {
      this.formPessoaFisicaEmailValidated =
        await this.$refs.formPessoaFisicaEmail.validate();
      if (!this.formPessoaFisicaEmailValidated) {
        return false;
      }

      if (this.tblPessoaFisicaEmail.editedIndex > -1) {
        const { status } = await this.updatePessoaFisicaEmail(
          this.tblPessoaFisicaEmail
        );
        if (status == 200)
          Swal.messageToast(this.$strings.msg_alterar, "success");
      } else {
        this.tblPessoaFisicaEmail.pessoa_fisica_id = this.$route.params.id;
        const { status } = await this.createPessoaFisicaEmail(
          this.tblPessoaFisicaEmail
        );
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
      await this.itemById(this.$route.params.id);
      this.resetPessoaFisicaEmail();
      this.closePessoaFisicaEmail();
      this.tblPessoaFisicaEmail.editedIndex = -1;
    },

    async deletePessoaFisicaEmailConfirm() {
      const { id } =
        this.form.pessoa_fisica_email[this.tblPessoaFisicaEmail.editedIndex];
      const { status } = await this.deletePessoaFisicaEmail(id);
      if (status == 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.itemById(this.$route.params.id);
      }
      this.tblPessoaFisicaEmail.dialogDelete = false;
    },
    async savePessoaFisicaDocumento() {
      this.formPessoaFisicaDocumentoValidated =
        await this.$refs.formPessoaFisicaDocumento.validate();
      if (!this.formPessoaFisicaDocumentoValidated) {
        return false;
      }

      if (this.tblPessoaFisicaDocumento.editedIndex > -1) {
        const { status } = await this.updatePessoaFisicaDocumento(
          this.tblPessoaFisicaDocumento
        );
        if (status == 200)
          Swal.messageToast(this.$strings.msg_alterar, "success");
      } else {
        this.tblPessoaFisicaDocumento.pessoa_fisica_id = this.$route.params.id;
        const { status } = await this.createPessoaFisicaDocumento(
          this.tblPessoaFisicaDocumento
        );
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
      await this.itemById(this.$route.params.id);
      this.resetPessoaFisicaDocumento();
      this.closePessoaFisicaDocumento();
      this.tblPessoaFisicaDocumento.editedIndex = -1;
    },

    async deletePessoaFisicaDocumentoConfirm() {
      const { id } =
        this.form.pessoa_fisica_documento[
          this.tblPessoaFisicaDocumento.editedIndex
        ];
      const { status } = await this.deletePessoaFisicaDocumento(id);
      if (status == 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.itemById(this.$route.params.id);
      }
      this.tblPessoaFisicaDocumento.dialogDelete = false;
    },
    async savePessoaFisicaEndereco() {
      this.formPessoaFisicaEnderecoValidated =
        await this.$refs.formPessoaFisicaEndereco.validate();
      if (!this.formPessoaFisicaEnderecoValidated) {
        return false;
      }

      if (this.tblPessoaFisicaEndereco.editedIndex > -1) {
        const { status } = await this.updatePessoaFisicaEndereco(
          this.tblPessoaFisicaEndereco
        );
        if (status == 200)
          Swal.messageToast(this.$strings.msg_alterar, "success");
      } else {
        this.tblPessoaFisicaEndereco.pessoa_fisica_id = this.$route.params.id;
        const { status } = await this.createPessoaFisicaEndereco(
          this.tblPessoaFisicaEndereco
        );
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
      await this.itemById(this.$route.params.id);
      this.resetPessoaFisicaEndereco();
      this.closePessoaFisicaEndereco();
      this.tblPessoaFisicaEndereco.editedIndex = -1;
    },

    async deletePessoaFisicaEnderecoConfirm() {
      const { id } =
        this.form.pessoa_fisica_endereco[
          this.tblPessoaFisicaEndereco.editedIndex
        ];
      const { status } = await this.deletePessoaFisicaEndereco(id);
      if (status == 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.itemById(this.$route.params.id);
      }
      this.tblPessoaFisicaEndereco.dialogDelete = false;
    },
    async savePessoaFisicaMeioComunicacao() {
      this.formPessoaFisicaMeioComunicacaoValidated =
        await this.$refs.formPessoaFisicaMeioComunicacao.validate();
      if (!this.formPessoaFisicaMeioComunicacaoValidated) {
        return false;
      }

      if (this.tblPessoaFisicaMeioComunicacao.editedIndex > -1) {
        const { status } = await this.updatePessoaFisicaMeioComunicacao(
          this.tblPessoaFisicaMeioComunicacao
        );
        if (status == 200)
          Swal.messageToast(this.$strings.msg_alterar, "success");
      } else {
        this.tblPessoaFisicaMeioComunicacao.pessoa_fisica_id =
          this.$route.params.id;
        const { status } = await this.createPessoaFisicaMeioComunicacao(
          this.tblPessoaFisicaMeioComunicacao
        );
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
      await this.itemById(this.$route.params.id);
      this.resetPessoaFisicaMeioComunicacao();
      this.closePessoaFisicaMeioComunicacao();
      this.tblPessoaFisicaMeioComunicacao.editedIndex = -1;
    },

    async deletePessoaFisicaMeioComunicacaoConfirm() {
      const { id } =
        this.form.pessoa_fisica_meio_comunicacao[
          this.tblPessoaFisicaMeioComunicacao.editedIndex
        ];
      const { status } = await this.deletePessoaFisicaMeioComunicacao(id);
      if (status == 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.itemById(this.$route.params.id);
      }
      this.tblPessoaFisicaMeioComunicacao.dialogDelete = false;
    },
    async editPessoaFisicaEmail(item) {
      await this.pessoaFisicaEmailById(item.id);

      this.tblPessoaFisicaEmail.editedIndex =
        this.form.pessoa_fisica_email.indexOf(item);
      this.tblPessoaFisicaEmail.dialog = true;
    },

    deletePessoaFisicaEmailDialog(item) {
      this.tblPessoaFisicaEmail.editedIndex =
        this.form.pessoa_fisica_email.indexOf(item);
      this.tblPessoaFisicaEmail.dialogDelete = true;
    },

    closePessoaFisicaEmail() {
      this.tblPessoaFisicaEmail.dialog = false;
      this.tblPessoaFisicaEmail = { ...constants.tblPessoaFisicaEmail };
    },

    closeDeletePessoaFisicaEmail() {
      this.tblPessoaFisicaEmail.dialogDelete = false;
      this.tblPessoaFisicaEmail = { ...constants.tblPessoaFisicaEmail };
    },

    closePessoaFisicaDocumento() {
      this.tblPessoaFisicaDocumento.dialog = false;
      this.tblPessoaFisicaDocumento = { ...constants.tblPessoaFisicaDocumento };
      this.$refs.formPessoaFisicaDocumento.reset();
    },

    closeDeletePessoaFisicaDocumento() {
      this.tblPessoaFisicaDocumento.dialogDelete = false;
      this.tblPessoaFisicaDocumento = { ...constants.tblPessoaFisicaDocumento };
      this.$refs.formPessoaFisicaDocumento.reset();
    },
    async editPessoaFisicaEndereco(item) {
      await this.pessoaFisicaEnderecoById(item.id);

      this.tblPessoaFisicaEndereco.editedIndex =
        this.form.pessoa_fisica_endereco.indexOf(item);
      this.tblPessoaFisicaEndereco.dialog = true;
    },

    deletePessoaFisicaEnderecoDialog(item) {
      this.tblPessoaFisicaEndereco.editedIndex =
        this.form.pessoa_fisica_endereco.indexOf(item);
      this.tblPessoaFisicaEndereco.dialogDelete = true;
    },

    closePessoaFisicaEndereco() {
      this.tblPessoaFisicaEndereco.dialog = false;
      this.tblPessoaFisicaEndereco = { ...constants.tblPessoaFisicaEndereco };
    },

    closeDeletePessoaFisicaEndereco() {
      this.tblPessoaFisicaEndereco.dialogDelete = false;
      this.tblPessoaFisicaEndereco = { ...constants.tblPessoaFisicaEndereco };
    },
    async editPessoaFisicaMeioComunicacao(item) {
      await this.pessoaFisicaMeioComunicacaoById(item.id);

      this.tblPessoaFisicaMeioComunicacao.editedIndex =
        this.form.pessoa_fisica_meio_comunicacao.indexOf(item);
      this.tblPessoaFisicaMeioComunicacao.dialog = true;
    },

    deletePessoaFisicaMeioComunicacaoDialog(item) {
      this.tblPessoaFisicaMeioComunicacao.editedIndex =
        this.form.pessoa_fisica_meio_comunicacao.indexOf(item);
      this.tblPessoaFisicaMeioComunicacao.dialogDelete = true;
    },

    closePessoaFisicaMeioComunicacao() {
      this.tblPessoaFisicaMeioComunicacao.dialog = false;
      this.tblPessoaFisicaMeioComunicacao = {
        ...constants.tblPessoaFisicaMeioComunicacao,
      };
    },

    closeDeletePessoaFisicaMeioComunicacao() {
      this.tblPessoaFisicaMeioComunicacao.dialogDelete = false;
      this.tblPessoaFisicaMeioComunicacao = {
        ...constants.tblPessoaFisicaMeioComunicacao,
      };
    },
  },
  watch: {
    getTipoLogradouro(items) {
      this.form.tipo_logradouro = items.data;
    },

    getMunicipio(items) {
      this.form.municipio = items.data;
    },

    getTipoEndereco(items) {
      this.form.tipo_endereco = items.data;
    },

    getMeioComunicacao(items) {
      this.form.meio_comunicacao = items.data;
    },

    getTipoDocumento(items) {
      this.form.tipo_documento = items.data;
    },

    getPessoaFisicaEmailById(pessoaFisicaEmail) {
      const { id, pessoa_fisica_id, email, eh_principal } = pessoaFisicaEmail;
      this.tblPessoaFisicaEmail.id = id;
      this.tblPessoaFisicaEmail.pessoa_fisica_id = pessoa_fisica_id;
      this.tblPessoaFisicaEmail.email = email;
      this.tblPessoaFisicaEmail.eh_principal = eh_principal;
    },

    getPessoaFisicaDocumentoById(pessoaFisicaDocumento) {
      const {
        id,
        pessoa_fisica_id,
        tipo_documento_id,
        inscricao,
        complemento,
      } = pessoaFisicaDocumento;
      this.tblPessoaFisicaDocumento.id = id;
      this.tblPessoaFisicaDocumento.pessoa_fisica_id = pessoa_fisica_id;
      this.tblPessoaFisicaDocumento.tipo_documento_id = tipo_documento_id;
      this.tblPessoaFisicaDocumento.inscricao = inscricao;
      this.tblPessoaFisicaDocumento.complemento = complemento;
    },

    getPessoaFisicaEnderecoById(pessoaFisicaEndereco) {
      const {
        id,
        pessoa_fisica_id,
        endereco_id,
        tipo_endereco_id,
        eh_principal,
        endereco,
      } = pessoaFisicaEndereco;
      this.tblPessoaFisicaEndereco.id = id;
      this.tblPessoaFisicaEndereco.pessoa_fisica_id = pessoa_fisica_id;
      this.tblPessoaFisicaEndereco.endereco_id = endereco_id;
      this.tblPessoaFisicaEndereco.tipo_endereco_id = tipo_endereco_id;
      this.tblPessoaFisicaEndereco.eh_principal = eh_principal;
      this.tblPessoaFisicaEndereco.endereco.id = endereco.id;
      this.tblPessoaFisicaEndereco.endereco.tipo_logradouro_id =
        endereco.tipo_logradouro_id;
      this.tblPessoaFisicaEndereco.endereco.logradouro = endereco.logradouro;
      this.tblPessoaFisicaEndereco.endereco.numero = endereco.numero;
      this.tblPessoaFisicaEndereco.endereco.complemento = endereco.complemento;
      this.tblPessoaFisicaEndereco.endereco.bairro = endereco.bairro;
      this.tblPessoaFisicaEndereco.endereco.ponto_referencia =
        endereco.ponto_referencia;
      this.tblPessoaFisicaEndereco.endereco.cep = endereco.cep;
      this.tblPessoaFisicaEndereco.endereco.municipio_id =
        endereco.municipio_id;
      this.tblPessoaFisicaEndereco.endereco.eh_endereco_brasil =
        endereco.eh_endereco_brasil;
    },

    getPessoaFisicaMeioComunicacaoById(pessoaFisicaMeioComunicacao) {
      const {
        id,
        pessoa_fisica_id,
        meio_comunicacao_id,
        descricao,
        eh_principal,
        eh_whatsapp,
      } = pessoaFisicaMeioComunicacao;
      this.tblPessoaFisicaMeioComunicacao.id = id;
      this.tblPessoaFisicaMeioComunicacao.pessoa_fisica_id = pessoa_fisica_id;
      this.tblPessoaFisicaMeioComunicacao.meio_comunicacao_id =
        meio_comunicacao_id;
      this.tblPessoaFisicaMeioComunicacao.descricao = descricao;
      this.tblPessoaFisicaMeioComunicacao.eh_principal = eh_principal;
      this.tblPessoaFisicaMeioComunicacao.eh_whatsapp = eh_whatsapp;
    },

    getItemById(item) {
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.form);
        keys.forEach((i) => {
          if (item[i]) {
            this.form[i] = item[i];
          }
        });
      }
    },
  },
};
</script>
<style lang="scss" scoped></style>
