import 'piccolore';
import { A as AstroError, I as InvalidComponentArgs, c as createRenderInstruction, m as maybeRenderHead, a as renderTemplate, r as renderComponent, d as renderSlot, e as renderHead, b as addAttribute } from './prerender_CZsszPLm.mjs';
import 'clsx';

function validateArgs(args) {
  if (args.length !== 3) return false;
  if (!args[0] || typeof args[0] !== "object") return false;
  return true;
}
function baseCreateComponent(cb, moduleId, propagation) {
  const name = moduleId?.split("/").pop()?.replace(".astro", "") ?? "";
  const fn = (...args) => {
    if (!validateArgs(args)) {
      throw new AstroError({
        ...InvalidComponentArgs,
        message: InvalidComponentArgs.message(name)
      });
    }
    return cb(...args);
  };
  Object.defineProperty(fn, "name", { value: name, writable: false });
  fn.isAstroComponentFactory = true;
  fn.moduleId = moduleId;
  fn.propagation = propagation;
  return fn;
}
function createComponentWithOptions(opts) {
  const cb = baseCreateComponent(opts.factory, opts.moduleId, opts.propagation);
  return cb;
}
function createComponent(arg1, moduleId, propagation) {
  if (typeof arg1 === "function") {
    return baseCreateComponent(arg1, moduleId, propagation);
  } else {
    return createComponentWithOptions(arg1);
  }
}

async function renderScript(result, id) {
  const inlined = result.inlinedScripts.get(id);
  let content = "";
  if (inlined != null) {
    if (inlined) {
      content = `<script type="module">${inlined}</script>`;
    }
  } else {
    const resolved = await result.resolve(id);
    content = `<script type="module" src="${result.userAssetsBase ? (result.base === "/" ? "" : result.base) + result.userAssetsBase : ""}${resolved}"></script>`;
  }
  return createRenderInstruction({ type: "script", id, content });
}

const $$Footer = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<footer class="bg-[#1A1A1A] text-white pt-12 pb-6"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Grid principal --> <div class="grid md:grid-cols-4 gap-8 mb-8"> <!-- Columna 1: Logo / Info --> <div> <div class="flex items-center justify-center md:justify-start space-x-2 mb-4"> <div class="w-10 h-10 bg-[#D2B48C] rounded-full flex items-center justify-center"> <span class="text-[#1A1A1A] font-bold text-xl">M</span> </div> <div> <span class="font-bold">Montero</span> <span class="text-gray-400">Maintenance</span> <p class="text-xs text-gray-500">LLC</p> </div> </div> <p class="text-gray-400 text-sm text-center md:text-left">
Keeping your property looking its best year-round.
</p> </div> <!-- Columna 2: Site Map --> <div> <h4 class="font-bold text-lg mb-4 text-center md:text-left">Site Map</h4> <ul class="space-y-2 text-center md:text-left"> <li><a href="/" class="text-gray-400 hover:text-[#D2B48C] transition-colors text-sm">Home</a></li> <li><a href="/about" class="text-gray-400 hover:text-[#D2B48C] transition-colors text-sm">About</a></li> <li><a href="/services" class="text-gray-400 hover:text-[#D2B48C] transition-colors text-sm">Services</a></li> <li><a href="/contact" class="text-gray-400 hover:text-[#D2B48C] transition-colors text-sm">Contact</a></li> </ul> </div> <!-- Columna 3: Social Media --> <div> <h4 class="font-bold text-lg mb-4 text-center md:text-left">Social Media</h4> <div class="flex justify-center md:justify-start space-x-4"> <a href="https://www.facebook.com/yourpage" class="text-gray-400 hover:text-[#D2B48C] transition-colors" aria-label="Facebook"> <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"> <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12z"></path> </svg> </a> <a href="https://www.instagram.com/yourprofile" class="text-gray-400 hover:text-[#D2B48C] transition-colors" aria-label="Instagram"> <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"> <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4z"></path> </svg> </a> </div> </div> <!-- Columna 4: Contacto / Horario --> <div> <h4 class="font-bold text-lg mb-4 text-center md:text-left">Contact</h4> <ul class="space-y-2 text-center md:text-left"> <li class="text-gray-400 text-sm"> +1 609-464-9834</li> <li class="text-gray-400 text-sm">contact@monteromaintenance.com</li> <li class="text-gray-400 text-sm"> Mon-Fri: 8am - 6pm</li> </ul> </div> </div> <!-- Línea divisoria --> <div class="border-t border-gray-800 pt-6"> <div class="flex flex-col md:flex-row justify-between items-center gap-4"> <p class="text-gray-500 text-sm">
&copy; ${(/* @__PURE__ */ new Date()).getFullYear()} Montero Maintenance LLC. All rights reserved.
</p> </div> </div> </div> </footer>`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/footer.astro", void 0);

var __freeze = Object.freeze;
var __defProp = Object.defineProperty;
var __template = (cooked, raw) => __freeze(__defProp(cooked, "raw", { value: __freeze(cooked.slice()) }));
var _a;
const $$Layout = createComponent(($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$props, $$slots);
  Astro2.self = $$Layout;
  const { title, description } = Astro2.props;
  return renderTemplate(_a || (_a = __template(['<html lang="es"> <head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Título de la página --><title> ', " | Montero Maintenance</title><!-- Meta descripción (si se proporciona) -->", '<!-- Metaetiquetas adicionales para SEO --><meta name="robots" content="index, follow"><meta name="author" content="Montero Maintenance">', '</head> <body> <main class="mx-auto container md:pt-10"> ', " </main> ", ' <script src="https://www.google.com/recaptcha/api.js" async defer><\/script> ', " </body> </html>"])), title, description && renderTemplate`<meta name="description"${addAttribute(description, "content")}>`, renderHead(), renderSlot($$result, $$slots["default"]), renderComponent($$result, "Footer", $$Footer, {}), renderScript($$result, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/Layouts/Layout.astro?astro&type=script&index=0&lang.ts"));
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/Layouts/Layout.astro", void 0);

const $$Header = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-sm"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="flex justify-between items-center py-4"> <!-- Logo y nombre - Enlace a home --> <a href="/" class="flex items-center space-x-2 group cursor-pointer"> <img src="/images/logoMontero.jpeg" alt="Montero Maintenance Logo" class="w-25 h-25 rounded-full object-cover group-hover:opacity-80 transition-opacity"> <div> <span class="text-xl font-bold text-[#1A1A1A]">Montero</span> <span class="text-xl font-bold text-[#6B7280]">Maintenance</span> </div> </a> <!-- Navegación Desktop --> <nav class="hidden md:flex space-x-8"> <a href="/" class="text-[#4B5563] hover:text-[#D2B48C] transition-colors">Home</a> <a href="/about" class="text-[#4B5563] hover:text-[#D2B48C] transition-colors">About</a> <a href="/Services" class="text-[#4B5563] hover:text-[#D2B48C] transition-colors">Services</a> <a href="/contact" class="text-[#4B5563] hover:text-[#D2B48C] transition-colors">Contact</a> </nav> <!-- Botón menú móvil --> <button id="menu-btn" class="md:hidden text-[#1A1A1A]"> <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path> </svg> </button> </div> <!-- Menú móvil --> <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-3"> <a href="/" class="block py-2 text-[#4B5563] hover:text-[#D2B48C]">Home</a> <a href="/about" class="block py-2 text-[#4B5563] hover:text-[#D2B48C]">About</a> <a href="/Services" class="block py-2 text-[#4B5563] hover:text-[#D2B48C]">Services</a> <a href="/contact" class="block py-2 text-[#4B5563] hover:text-[#D2B48C]">Contact</a> </div> </div> </header> ${renderScript($$result, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/Header.astro?astro&type=script&index=0&lang.ts")}`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/Landing/Header.astro", void 0);

export { $$Layout as $, $$Header as a, createComponent as c, renderScript as r };
