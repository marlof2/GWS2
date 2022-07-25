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
  return await api.deleteItem(id);
};

const downloadAnexo = async (context, params) => {
  return await api.downloadAnexo(params.id);

  // console.log(response);
  // const url = window.URL.createObjectURL(new Blob([response.data]));
  // const link = document.createElement("a");
  // link.href = url;
  // link.setAttribute("download", params.name);
  // document.body.appendChild(link);
  // link.click();

  // return response

};

export default {
  getItems,
  getItemById,
  createItem,
  updateItem,
  deleteItem,
  downloadAnexo,
};
