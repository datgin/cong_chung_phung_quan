export function truncateWords(str, limit) {
  if (!str) return "";
  const words = str.trim().split(/\s+/);
  if (words.length <= limit) return str;
  return words.slice(0, limit).join(" ") + "...";
}

export const formatPhone = (phone) => {
  if (!phone) return "";
  const digits = phone.replace(/\D/g, ""); // loại bỏ ký tự không phải số
  if (digits.length !== 10) return phone; // nếu không đủ 10 số thì trả nguyên
  return `${digits.slice(0, 4)}.${digits.slice(4, 7)}.${digits.slice(7)}`;
};
