export const WHATSAPP_NUMBER = "5562991525466";

export function whatsappUrl(text = "") {
  const base = `https://wa.me/${WHATSAPP_NUMBER}`;
  const message = text.trim();
  if (!message) {
    return base;
  }
  return `${base}?text=${encodeURIComponent(message)}`;
}

export function whatsappWebUrl(text = "") {
  const params = new URLSearchParams({ phone: WHATSAPP_NUMBER });
  const message = text.trim();
  if (message) {
    params.set("text", message);
  }
  return `https://web.whatsapp.com/send?${params.toString()}`;
}
