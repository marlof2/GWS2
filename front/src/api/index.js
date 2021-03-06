import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

import Jwt from "@/api/jwt";

import storeError from "../modules/error/_store";
import storeRequest from "../modules/request/_store";
import store from "../store";

import Router from "../router";
import swal from "sweetalert2";

const Api = {
  init() {
    Vue.use(VueAxios, axios);
    this.setupHeaders();

    Vue.axios.defaults.baseURL = process.env.VUE_APP_URL_API;

    Vue.axios.interceptors.response.use(function (response) {
      // store.dispatch("$_error/setErrors", []);
      return response;
    }, this.handleError.bind(this));

    const STORE_KEY_ERROR = "$_error";
    if (!(STORE_KEY_ERROR in store._modules.root._children)) {
      store.registerModule(STORE_KEY_ERROR, storeError);
    }

    const STORE_KEY_REQUEST = "$_request";
    if (!(STORE_KEY_REQUEST in store._modules.root._children)) {
      store.registerModule(STORE_KEY_REQUEST, storeRequest);
    }

    this.addIntercepetRequest();
  },

  async addIntercepetRequest() {
    var numberOfAjaxCAllPending = 0;

    axios.interceptors.request.use(
      async function (config) {
        numberOfAjaxCAllPending++;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);
        return config;
      },
      function (error) {
        return Promise.reject(error);
      }
    );

    axios.interceptors.response.use(
      async function (response) {
        numberOfAjaxCAllPending--;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);

        return response;
      },
      async function (error) {
        numberOfAjaxCAllPending--;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);

        return Promise.reject(error);
      }
    );
  },
  setupHeaders() {
    Vue.axios.defaults.headers.common["Content-Type"] = "application/json";
    Vue.axios.defaults.headers.common["Accept"] = "application/json";
    Vue.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${Jwt.getToken()}`;
    ["get", "post", "put", "patch"].forEach(function (method) {
      Vue.axios.defaults.headers[method]["Content-Type"] = "application/json";
    });
  },
  checkResponse(response) {
    if (!response) {
      return {
        data: "",
        status: 500,
        statusText: "",
      };
    }
    return response;
  },
  async handleError(errRef) {
    if (!errRef.response) {
      return;
    }
    let response = errRef.response;
    let dataResponse = this.checkResponse(response);

    // await store.dispatch("$_error/setErrors", []);

    const code = dataResponse.status ? dataResponse.status : 0;
    var errorMsg = "";
    let typeMessage = "warning";
    if (Object.prototype.hasOwnProperty.call(dataResponse.data, "mensagem"))
      errorMsg = dataResponse.data.mensagem;
    switch (code) {
      case 400:
        this.messageError(dataResponse, dataResponse.data.message);
        break;

      case 0:
      case 401:
        if (dataResponse.data.message == "Unauthenticated.") {
          Jwt.destroyToken();
          window.location = "autenticar";
          // Router.push({ path: "/autenticar" });
          // console.log(Router);
        } else {
          this.messageError(
            dataResponse,
            dataResponse.data.message,
            dataResponse.data.title,
            dataResponse.data.type
          );
        }
        break;

      case 404:
        const { error } = dataResponse.data;
        this.messageError(null, error, "Algo inesperado ocorreu!", "error");
        break;

      case 406:
        let messageTitle = dataResponse.data.message;
        let erros = dataResponse.data.error;
        let bodyMessage = "";

        if (dataResponse.data.error.errorInfo[0] == 23000) {
          erros = "N??o ?? poss??vel deletar um cliente enquanto o mesmo estiver associado a uma programac??o."
        }

        Object.keys(erros).forEach((item) => {
          bodyMessage += erros[item];
        });

        this.messageError(
          dataResponse,
          bodyMessage,
          messageTitle,
          (typeMessage = "error")
        );

        break;

      case 422:
        //await store.dispatch("$_error/setErrors", dataResponse.data);

        if (Object.prototype.hasOwnProperty.call(dataResponse.data, "type")) {
          typeMessage = dataResponse.data.type;
        }

        await store.dispatch("$_messages/setErrors", {
          title: dataResponse.data.title,
          message: dataResponse.data.message,
          type: typeMessage,
          //timeout: 20000
        });
        //this.messageErrorCustom(dataResponse);
        break;

      case 500:
        errorMsg
          ? errorMsg
          : (errorMsg = "Aguarde um pouco e tente novamente.");
        this.messageError(dataResponse, errorMsg, "", "Erro interno");
        break;
    }
    if (code === 406) {
      return new Promise((resolve, reject) => {
        reject(dataResponse);
      });
    }
  },

  async messageError(response, message, messageTitle, messageType) {
    // await store.dispatch("$_error/setErrors", response.data);
    swal.fire({
      icon: messageType,
      title: messageTitle,
      text: message,
    });

    if (Object.prototype.hasOwnProperty.call(response.data, "status")) {
      if (response.data.status === 401) {
        Jwt.destroyToken();
        Router.push({ name: "login" });
      }
    }
  },

  async query(resource, data) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(resource, { params: data });
      resolve(result);
    });
    return promiseData;
  },

  async queryDownload(resource, data) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(
        resource,
        { params: data },
        {
          responseType: "blob",
        }
      );
      resolve(result);
    });
    return promiseData;
  },

  async queryDownloadXlsx(resource, data) {
    const promiseData = new Promise((resolve) => {
      Vue.axios({
        method: "get",
        url: resource,
        resource,
        params: data,
        responseType: "arraybuffer",
        headers: {
          Accept:
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        },
      }).then((response) => {
        resolve(response);
      });
    });
    return promiseData;
  },

  async get(resource, slug = "") {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(`${resource}/${slug}`);
      resolve(result);
    });
    return promiseData;
  },

  async post(resource, params) {
    const result = await Vue.axios.post(`${resource}`, JSON.stringify(params));
    return result;
  },

  async postFormData(resource, params) {
    return new Promise((resolve) => {
      const result = Vue.axios.post(`${resource}`, params, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      resolve(result);
    });
  },

  async put(resource, id, params) {
    const route = id ? `${resource}/${id}` : resource;
    const result = await Vue.axios.put(route, JSON.stringify(params));
    return result;
  },

  patch(resource, id, params) {
    if (id) {
      return Vue.axios.patch(`${resource}/${id}`, JSON.stringify(params));
    } else {
      return Vue.axios.patch(`${resource}`, JSON.stringify(params));
    }
  },

  delete(resource, id) {
    return new Promise((resolve) => {
      const result = Vue.axios.delete(`${resource}/${id}`);
      resolve(result);
    });
  },
};

export default Api;
