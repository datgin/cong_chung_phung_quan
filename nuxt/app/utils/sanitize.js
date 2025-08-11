// utils/sanitize.js
import createDOMPurify from "dompurify";

let DOMPurify;

if (import.meta.client) {
  DOMPurify = createDOMPurify(window);
}

export function sanitizeHTML(html) {
  if (import.meta.client && DOMPurify) {
    const clean = DOMPurify.sanitize(html);

    // Dùng DOMParser để xử lý DOM tiếp (chèn mô tả ảnh)
    const parser = new DOMParser();
    const doc = parser.parseFromString(clean, "text/html");

    const images = doc.querySelectorAll("img");

    images.forEach((img) => {
      const alt = img.getAttribute("alt");
      if (alt) {
        const caption = document.createElement("span");
        caption.className = "image-caption";
        caption.textContent = alt;
        img.insertAdjacentElement("afterend", caption);
      }

      // Đảm bảo căn giữa ảnh (nếu CSS fail)
      img.style.display = "block";
      img.style.marginLeft = "auto";
      img.style.marginRight = "auto";
    });

    return doc.body.innerHTML;
  }

  // Nếu đang SSR hoặc DOMPurify chưa được khởi tạo, trả raw HTML
  return html;
}
