import React from 'react';

import { Footer } from './footer';
import { Header } from './header';

interface ListProps {
  children: React.ReactNode;
  Header?: React.ComponentType<ListHeaderProps>;
  Footer?: React.ComponentType;
  Item?: React.ComponentType;
}

interface ListHeaderProps {
  title: string;
  description: string;
  actions?: React.ReactNode;
}

interface ListItemProps {
  children: React.ReactNode;
}

interface ListFooterProps {
  children?: React.ReactNode;
}

// Default Header component
const DefaultHeader: React.FC<ListHeaderProps> = ({ title, description, actions }) => (
  <Header title={title} description={description} actions={actions} />
);

// Default Footer component
const DefaultFooter: React.FC<{ children?: React.ReactNode }> = ({ children }) => <Footer>{children}</Footer>;

// Default Item component
const DefaultItem: React.FC<ListItemProps> = ({ children }) => <div className="px-4 py-3 sm:px-6">{children}</div>;

type ListComponentType = React.FC<ListProps> & {
  Header: React.ComponentType<ListHeaderProps>;
  Footer: React.ComponentType<ListFooterProps>;
  Item: React.ComponentType<ListItemProps>;
};

const List: ListComponentType = ({ children, Header, Footer, Item }: ListProps) => {
  const ComposedHeader = Header || DefaultHeader;
  const ComposedFooter = Footer || DefaultFooter;
  const ComposedItem = Item || DefaultItem;

  return (
    <div className="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
      {React.Children.map(children, (child) => {
        if (React.isValidElement(child)) {
          if (child.type === List.Header) {
            return <ComposedHeader {...child.props} />;
          }
          if (child.type === List.Item) {
            return <ComposedItem {...child.props} />;
          }
          if (child.type === List.Footer) {
            return <ComposedFooter {...child.props} />;
          }
        }
        return child;
      })}
    </div>
  );
};

// Static properties for usage
List.Header = DefaultHeader;
List.Footer = DefaultFooter;
List.Item = DefaultItem;

export { List };
