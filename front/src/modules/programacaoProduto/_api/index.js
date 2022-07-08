import Api from "@/api";
import { constants } from "../_constants";

const apiUrl = process.env.VUE_APP_URL_API + constants.routeMain;

const getItems = async (params) => {
  const result = await Api.query(apiUrl, params);
  if (result) {
    return result.data;
  }
  return false;
};

const getItemById = async (id) => {
  const result = await Api.get(apiUrl, id);
  if (result) {
    return result.data;
  }
  return false;
};

const updateItem = async (params) => {
  const id = params.programation_id;
  const result = await Api.put(apiUrl, id, params);
  if (result) {
    return result;
  }
  return false;
};

const createItem = async (params) => {
  const result = await Api.post(apiUrl, params);
  if (result) {
    return result;
  }
  return false;
};

const deleteItem = async (params) => {
  const result = await Api.post('programacaoprodutodelete', params);
  if (result) {
    return result;
  }
  return false;
};

export default {
  getItems,
  getItemById,
  createItem,
  updateItem,
  deleteItem,
};