const navItems = [
  { label: "Головна", href: "#hero" },
  { label: "Спецтехніка", href: "#equipment" },
  { label: "Послуги", href: "#services" },
  { label: "Об'єкти", href: "#projects" },
  { label: "Контакти", href: "#contact" },
];

const Footer = () => {
  return (
    <footer className="border-t border-border py-20">
      <div className="container mx-auto px-6 md:px-12">
        <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-10">
          <a href="#hero" className="text-foreground text-sm font-semibold tracking-[0.25em] uppercase">
            SANTA-PRIZE
          </a>
          <nav className="flex flex-wrap items-center gap-10">
            {navItems.map((item) => (
              <a
                key={item.href}
                href={item.href}
                className="text-muted-foreground text-[11px] tracking-[0.2em] uppercase hover:text-foreground transition-colors duration-300"
              >
                {item.label}
              </a>
            ))}
          </nav>
        </div>
        <div className="border-t border-border mt-16 pt-10">
          <p className="text-muted-foreground/40 text-[11px] tracking-[0.15em]">
            © {new Date().getFullYear()} SANTA-PRIZE
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
