import { useState, useCallback } from 'react';

interface PaginationProps {
  initialPage?: number;
  itemsPerPage: number;
}

interface PaginationReturn {
  currentPage: number;
  itemsPerPage: number;
  totalPages: number;
  setTotalPages: (totalPages: number) => void;
  goToPage: (page: number) => void;
}

export const usePagination = ({
  initialPage = 1,
  itemsPerPage = 10,
}: PaginationProps): PaginationReturn => {
  const [currentPage, setCurrentPage] = useState(initialPage);
  const [totalPages, setTotalPages] = useState(0);

  const goToPage = useCallback((page: number) => {
    const newPage = Math.max(1, Math.min(page, totalPages));
    setCurrentPage(newPage);
  }, [totalPages]);

  return {
    currentPage,
    itemsPerPage,
    totalPages,
    setTotalPages,
    goToPage,
  };
};