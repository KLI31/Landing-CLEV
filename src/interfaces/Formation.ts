export interface FormationBase {
    id: string;
    name: string;
    description: string;
    duration: string;
    image: string;
}

export interface Formation {
    id: string;
    editionId: string;
    formationId: string;
    formation: FormationBase;
    startDate: string;
    endDate: string;
}