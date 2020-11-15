/*
 Template Name: Drezoc - Responsive Bootstrap 4 Admin Dashboard
 Author: Myra Studio
 File: Mask js
*/


$(document).ready(function(){$('[data-toggle="input-mask"]').each(function(a,e){var t=$(e).data("maskFormat"),n=$(e).data("reverse");null!=n?$(e).mask(t,{reverse:n}):$(e).mask(t)})});
