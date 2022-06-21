import Api from "@/api";
import { constants } from "../_constants";

const url = process.env.VUE_APP_URL_API + constants.routeMain;

const getItems = async (params) => {
  const result = await Api.query(url, params);
  if (result) {
    return result.data;
  }
  return false;
};

const getItemById = async (user_key) => {
  const result = await Api.get(url, user_key);
  if (result) {
    return result.data;
  }
  return false;
};

const updateItem = async (params) => {
  const user_key = params.user_key;
  delete params.user_key;
  const result = await Api.put(url, user_key, params);
  if (result) {
    return result;
  }
  return false;
};

const createItem = async (params) => {
  const result = await Api.post(url, params);
  if (result) {
    return result;
  }
  return false;
};

const deleteItem = async (id) => {
  const result = await Api.delete(url, id);
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
