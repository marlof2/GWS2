import api from "../_api";

const getItems = async (context, params) => {
  const result = await api.getItems(params);
  context.commit("STORE_ITEMS", result);
  return result;
};

const getItemById = async (context, params) => {
  const result = await api.getItemById(params);
  context.commit("STORE_ITEM_BY_ID", result);
};

const createItem = async (context, object) => {
  return await api.createItem(object);
};

const updateItem = async (context, object) => {
  return await api.updateItem(object);
};

const deleteItem = async (context, id) => {
  const result = await api.deleteItem(id);
};

const atender = async (context, id) => {
  return await api.atender(id);
};

const naoAtender = async (context, id) => {
  return await api.naoAtender(id);
};

const flagAtender = async (context, params) => {
  context.commit("ATENDER", params);
};

const flagNaoAtender = async (context, params) => {
  context.commit("NAO_ATENDER", params);
};

const flagImprimir = async (context, params) => {
  context.commit("IMPRIMIR", params);
};

const flagComprovante = async (context, params) => {
  context.commit("COMPROVANTE", params);
};

export default {
  getItems,
  getItemById,
  createItem,
  updateItem,
  deleteItem,
  atender,
  naoAtender,
  flagAtender,
  flagNaoAtender,
  flagImprimir,
  flagComprovante,
};
