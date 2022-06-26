import * as smask from "../libs/smask-main/dist/smask.js";

if (!!document.getElementById("celular"))
    smask.input("#celular", ["(dd) ddddd-dddd"]);

if (!!document.getElementById("telefone"))
    smask.input("#telefone", ["(dd) ddddd-dddd"]);

if (!!document.getElementById("cpf"))
    smask.input("#cpf", ["ddd.ddd.ddd-dd"]);


if (!!document.getElementById("altura"))
    smask.input("#altura", ["d.dd"]);
