import { color } from "echarts/lib/theme/light";
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
  message(titulo = "", texto, tipoIcone = "success", color = "#008A5E") {
    Swal.fire({
      position: "center",
      icon: tipoIcone,
      title: titulo,
      text: texto,
      showConfirmButton: true,
      confirmButtonColor: color,
      // timer: 1500,
    });
  },
  messageToast(titulo = "", tipoIcone = "success", position = "top-end") {
    Swal.fire({
      toast: true,
      title: titulo,
      icon: tipoIcone,
      position: position,
      showConfirmButton: false,
      timer: 6000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
  },
};

// Swal.message("testou", "teste com sucesso");
