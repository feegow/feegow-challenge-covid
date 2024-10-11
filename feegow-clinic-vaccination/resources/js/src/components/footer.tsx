import { Flex, Text } from "@radix-ui/themes";

export default function Footer() {
    const { COMPANY_NAME } = window as any;

    return (
        <Flex
            py="20px"
            align="center"
            justify="center"
            style={{ backgroundColor: "var(--gray-2)" }}
        >
            <Text size="2" color="gray" align="center">
                &copy; {new Date().getFullYear()} {COMPANY_NAME}. All rights
                reserved.
            </Text>
        </Flex>
    );
}
