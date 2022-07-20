import { constants } from "../_constants";

const itemsStateName = Object.keys(constants.state);

const STORE_ITEMS = (state, itemsState) => {
  state[itemsStateName[0]] = itemsState;
};

const STORE_ITEM_BY_ID = (state, itemState) => {
  state[itemsStateName[1]] = itemState;
}

const ATENDER = (state, itemsState) => {
  state[itemsStateName[2]] = itemsState;
};
const NAO_ATENDER = (state, itemsState) => {
  state[itemsStateName[3]] = itemsState;
};

const IMPRIMIR = (state, itemsState) => {
  state[itemsStateName[4]] = itemsState;
};

const COMPROVANTE = (state, itemsState) => {
  state[itemsStateName[5]] = itemsState;
};

export default {
  STORE_ITEMS,
  STORE_ITEM_BY_ID,
  ATENDER,
  NAO_ATENDER,
  IMPRIMIR,
  IMPRIMIR,
  COMPROVANTE,
}