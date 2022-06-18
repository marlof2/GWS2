const AUTHENTICATED = (state, authenticated) => {
  
  state.authenticated = authenticated;
};

const SET_AUTHORIZATION = (state, actualAuthorization) => {
  state.actualAuthorization = actualAuthorization;
};

const SISTEMAS_MODULOS_FUNCIONALIDADES_AUTORIZADAS = (state, usuarioPermissoes) => {
  state.usuarioPermissoes = usuarioPermissoes;
};

export default {
  AUTHENTICATED,
  SET_AUTHORIZATION,
  SISTEMAS_MODULOS_FUNCIONALIDADES_AUTORIZADAS,
};
