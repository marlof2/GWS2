const reloadIndex = async (context, params) => {
  context.commit("RELOAD_INDEX", params);
};

export default {
  reloadIndex,
};
