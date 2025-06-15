export interface Formation {
  id: string;
  name: string;
  slug: string;
  description: string;
  hours: string;
  imageUrl: string;
  isPrimary: boolean;
}

export interface Edition {
  id: string;
  editionCode: string;
  editionName: string;
  startDate: string;
  endDate: string;
  price: string;
  isActive: boolean;
}

export interface Enrollment {
  id: string;
  createdAt: string;
  updatedAt: string;
  isActive: boolean;
  edition: Edition;
  formations: Formation[];
}
