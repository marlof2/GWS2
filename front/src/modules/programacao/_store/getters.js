import { constants } from "../_constants";

const getItems = (state) => state[constants.routeMain];
const getItemById = (state) => state[`${constants.routeMain}ById`];

const flagAtender = state => state['flagAtender']
const flagNaoAtender = state => state['flagNaoAtender']
const flagImprimir = state => state['flagImprimir']
const flagComprovante = state => state['flagComprovante']
// const createUpload = state => state['createUpload']

export default {
  getItems,
  getItemById,
  flagAtender,
  flagNaoAtender,
  flagImprimir,
  flagComprovante,
  // createUpload,
};
