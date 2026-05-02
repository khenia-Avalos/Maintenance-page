import { c as createComponent } from './Header_u2Kcgok6.mjs';
import 'piccolore';
import { m as maybeRenderHead, b as addAttribute, a as renderTemplate } from './prerender_CZsszPLm.mjs';
import 'clsx';

const $$Button = createComponent(($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$props, $$slots);
  Astro2.self = $$Button;
  const { href, text } = Astro2.props;
  return renderTemplate`${href ? renderTemplate`${maybeRenderHead()}<a${addAttribute(href, "href")} class="inline-block bg-[#1A1A1A] text-white px-8 py-3 rounded-lg hover:bg-[#333333] transition-colors font-semibold">${text}</a>` : renderTemplate`<button class="inline-block bg-[#1A1A1A] text-white px-8 py-3 rounded-lg hover:bg-[#333333] transition-colors font-semibold">${text}</button>`}`;
}, "C:/Users/kheni/OneDrive/Escritorio/montero-landigpage/src/components/button.astro", void 0);

export { $$Button as $ };
