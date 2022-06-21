const newDate = new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
.toISOString()
.substr(0, 10);

const formatDate = (date) => {
  if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
}
export default {
  newDate,
  formatDate,
}
