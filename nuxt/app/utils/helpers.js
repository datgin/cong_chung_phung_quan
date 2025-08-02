export function truncateWords(str, limit) {
  if (!str) return "";
  const words = str.trim().split(/\s+/);
  if (words.length <= limit) return str;
  return words.slice(0, limit).join(" ") + "...";
}
