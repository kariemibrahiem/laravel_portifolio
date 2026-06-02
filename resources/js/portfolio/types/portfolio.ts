export interface Branding {
  siteName: string;
  logoUrl: string | null;
  mark: string;
}

export interface Profile {
  name: string;
  role: string;
  tagline: string;
  bio: string;
  avatarUrl: string | null;
  location: string;
  availability: string;
}

export interface HeroCta {
  label: string;
  href: string;
}

export interface Hero {
  eyebrow: string;
  title: string;
  subtitle: string;
  description: string;
  primaryCta: HeroCta;
  secondaryCta: HeroCta;
  terminalLabels: string[];
}

export interface StatItem {
  label: string;
  value: string;
  suffix: string;
}

export interface About {
  eyebrow: string;
  title: string;
  description: string;
  highlights: string[];
}

export interface ProcessItem {
  phase: string;
  title: string;
  description: string;
}

export interface ExperienceItem {
  id: number;
  title: string;
  company: string;
  description: string;
  startDate: string;
  endDate: string;
  iconClass: string | null;
  borderColor: string | null;
  sortOrder: number;
}

export interface PartnerSummary {
  id: number;
  name: string;
  imageUrl: string | null;
}

export interface CollaboratorSummary {
  id: number;
  name: string;
  imageUrl: string | null;
}

export interface ProjectItem {
  id: number;
  title: string;
  category: string;
  description: string;
  shortDescription: string;
  imageUrl: string | null;
  projectType: string;
  externalUrl: string | null;
  websiteUrl: string | null;
  googlePlayUrl: string | null;
  appStoreUrl: string | null;
  featured: boolean;
  sortOrder: number;
  badges: string[];
  partner: PartnerSummary | null;
  collaborators: CollaboratorSummary[];
}

export interface SkillItem {
  id: number;
  name: string;
  iconType: string;
  iconValue: string | null;
  iconUrl: string | null;
  sortOrder: number;
}

export interface TechItem {
  id: number;
  title: string;
  description: string | null;
  sortOrder: number;
}

export interface Contact {
  eyebrow: string;
  title: string;
  description: string;
  email: string;
  phone: string;
  location: string;
  availability: string;
  primaryCta: HeroCta;
}

export interface SocialItem {
  label: string;
  url: string;
  meta: string;
  abbr: string;
}

export interface PortfolioPagePayload {
  branding: Branding;
  profile: Profile;
  hero: Hero;
  stats: StatItem[];
  about: About;
  process: ProcessItem[];
  experiences: ExperienceItem[];
  projects: ProjectItem[];
  skills: SkillItem[];
  techs: TechItem[];
  contact: Contact;
  socials: SocialItem[];
}
