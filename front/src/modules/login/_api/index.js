import Api from "@/api";
import Jwt from "@/api/jwt";
import router from "../../../router";

const url = process.env.VUE_APP_URL_API;

const authenticate = async (params) => {
  const result = await Api.post(`${url}autenticar`, params);
  if (result) {
    if (result.data.token) Jwt.saveToken(result.data.token);
    return result.data;
  }
  return false;
};

const checkToken = async () => {
  const result = await Api.query("auth/usuario");
  if (result) {
    if (result.data.token) await Jwt.saveToken(result.data.token);

    return result;
  }
  return false;
};

const usuarioPermissoes = async (params) => {
  const result = await Api.query(`${url}usuariopermissoes`, params);
  if (result) {
    return result.data;
  }
  return false;
};

const logout = async () => {
  const result = await Api.post(`${url}logout`);
  if (result.status == 200) {
    await Jwt.destroyToken();
    router.push({ name: "autenticar" });
  }
  return false;
};

export default {
  authenticate,
  usuarioPermissoes,
  checkToken,
  logout,
};
