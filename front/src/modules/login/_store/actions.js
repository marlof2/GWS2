import api from "../_api";

const authenticate = async (context, object) => {
  const result = await api.authenticate(object);
  context.commit("AUTHENTICATED", result);
};

const usuarioPermissoes = async (context, params) => {
  const result = await api.usuarioPermissoes(params);
  context.commit("SISTEMAS_MODULOS_FUNCIONALIDADES_AUTORIZADAS", result);
};

const setAuthorization = async (context, object) => {
  context.commit("SET_AUTHORIZATION", object);
};

const checkToken = async (context) => {
  const result = await api.checkToken();
  context.commit("AUTHENTICATED", result.data);
};

const logout = async (context) => {
  const result = await api.logout();
  if (result) {
    context.commit("AUTHENTICATED", []);
  }
  return result;
};

export default {
  authenticate,
  usuarioPermissoes,
  checkToken,
  setAuthorization,
  logout,
};
