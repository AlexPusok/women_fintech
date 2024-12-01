-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 10:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `women_fintech`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `full_content` text NOT NULL,
  `author` varchar(120) NOT NULL,
  `published_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `description`, `full_content`, `author`, `published_on`) VALUES
(1, 'Women In Fintech: Empowering Change Through A Female-Forward Mission', 'Gerry Poirier is CEO and Founder of AngeLink, the leading female-powered crowdfunding platform, 2024 Best New Marketplace talks about her experience.', 'Financial disparity remains a significant challenge for many Americans, particularly for women. With 78% of U.S. households living paycheck-to-paycheck, most are unable to afford an unexpected $500 medical bill. What’s more, women bear the brunt of this financial pressure, with the majority of paycheck-to-paycheck households being female-led. High interest rates, skyrocketing rents and inflation have further compounded the financial strain, especially for single mothers, who head 80% of single-parent households.\r\n\r\nAdditionally, nearly 60% of adults in the United States feel uneasy about their emergency savings. Coupled with record-breaking years of billion-dollar weather disasters and rising inflation, women-led households are being left further behind than ever before.\r\n\r\nDespite their critical role, the fintech space has largely failed to address women’s unique needs. The crowdfunding market, currently valued at $166.95 billion, is driven by increasing local, national and global demand for online fundraising. As more people discover how peer-to-peer crowdfunding can be a fast and efficient way to raise money in emergencies or times of need, the market will continue to grow.\r\nWhy Your Story And Mission Matter\r\n\r\nI built my career in the finance world, working for over two decades on Wall Street. But my passion for creating change stems from my childhood. My grandmother, Annie, dedicated her life to helping orphans in her small rural community. Annie’s tradition of delivering gifts to underprivileged children during the holidays left a lasting mark on me, sparking my lifelong mission to pay it forward. It was this drive that eventually led me to found AngeLink.\r\n\r\nMy vision extends beyond simply offering a crowdfunding platform. Our core mission is to provide women and underserved communities with a safe, secure and trusted way to raise money quickly and easily with an empathetic and caring community.\r\n\r\nTo business leaders, I encourage you to look within your own story to find what drives you. Reflecting on the values and experiences that have shaped you can uncover powerful motivations to fuel your company’s mission. Maybe you have a family tradition of service, or perhaps you faced challenges early in your career that taught you the importance of resilience or empathy. These personal experiences can guide you in building a brand that resonates with both your team and your customers.\r\n\r\nTo deliver customer-centric value, you must start with a commitment to inclusivity. In my case, I noticed that women and marginalized communities face disproportionate barriers to financial support, so I built a platform that centers on their needs.\r\n\r\nThis approach is about more than adding helpful features—it’s about fundamentally understanding your customers\' struggles and aspirations. By keeping people at the heart of your decisions, you build not only a product but a community that resonates with your vision and mission.\r\nChanging The Narrative For Women In Fintech\r\n\r\nMy experience in financial services has been instrumental in securing investments, enabling the company to grow rapidly and attract attention from prominent partners. However, women\'s representation in the fintech space still needs to be improved.\r\n\r\nWomen in fintech are making significant strides, but gender disparities persist. As of 2023, women make up only 30% of positions in the fintech sector, a stark contrast to their male counterparts.\r\n\r\nAdditionally, women-led fintech companies face funding challenges. According to PitchBook, women founders received just 2.4% of venture capital funding in 2024, although women-led businesses have been shown to generate higher returns on investment in some studies.\r\n\r\nFor any founder—especially female founders or those leading women-focused ventures—building partnerships and securing funding requires strategic approaches and adaptability. Here’s what I’ve learned:\r\n\r\n• Cultivate a clear vision. Investors and partners respond to an authentic mission. It is invaluable to articulate how your product or service uniquely meets a market need, especially when that vision uplifts underrepresented groups.\r\n\r\n• Leverage mentorship and networking. Seek out organizations dedicated to supporting women entrepreneurs and founders. These networks are not only supportive but can open doors to funding and partnership opportunities. Organizations focused on female empowerment, for example, offer unique insights into navigating challenges and balancing growth with mission alignment.\r\n\r\n• Prioritize strategic listening. Often, it’s about tuning into feedback and recognizing patterns that others might overlook. I’ve found that listening carefully to advisors, mentors and even critics has enabled me to fine-tune our pitch and strengthen our platform’s core value propositions.\r\n\r\n• Build an inclusive culture. For other fintech leaders wanting to support female representation, it starts with an internal commitment. Foster an inclusive work environment, elevate diverse voices and ensure that your mission resonates internally before expanding it outward.\r\n\r\nMany overlook that investing in women-led tech companies isn\'t just about promoting equality—it\'s a smart strategy that offers higher returns and lower risks, particularly with women comprising 43% of entrepreneurs globally and 85% of all consumer purchases.\r\n\r\nMy ultimate goal is to change the narrative around gender equity and financial access. Bridging the gender gap in leadership roles, funding and career opportunities will be crucial to creating a more diverse and inclusive fintech ecosystem.\r\n\r\nIf women’s financial access is improved, women’s lives and downstream outcomes for families and society as a whole can be better impacted. Investing in women is, and continues to be, the way forward.', 'Gerry Poirier', '2024-12-01'),
(2, 'IWD 2024: What are the biggest challenges for women in FinTech?', 'On International Womens Day 2024, FinTech Global spoke to several key industry players in the FinTech space to understand some of the most pressing challenges for women in the industry.', 'Diversity and inclusion are running strong in the FinTech sector in 2024. Whilst increasing racial and gender diversity is permeating the market as the sector becomes more and more diverse, there is still some way to go for women.\r\n\r\nData from Gartner in 2023 found that investing in diversity and inclusion can be an incredible net positive for FinTech firms, with the data finding that getting diversity, equity and inclusion right can give a business 30% better performance overall. That being said, what are some of they key challenges for women in the FinTech space?\r\n\r\nMelanie Hayes, COO of KYND, said that while she’s proud to reflect on the strides women have made in the FinTech space, there’s still much ground to cover. “International Women’s Day isn’t just a celebration; it’s a reminder of the ongoing battle for gender equality, especially in sectors like ours where the imbalance remains pronounced.\r\n\r\n“At KYND, we are keenly aware of the significant challenges that persist for women in tech sectors, particularly cyber, and the crucial role we play in addressing these hurdles. While progress has been made, there’s still much work to be done to achieve gender balance and inclusivity within the industry.”\r\n\r\nHayes explained that one of the biggest hurdles women face is the underrepresentation in leadership positions. Despite many women easily possessing the same skills and expertise as their male counterparts, they often face barriers that can impede their progression into executive roles. She said that addressing this disparity demands concerted efforts to implement transparent promotion policies, mentorship programs, and leadership training initiatives.\r\n\r\n“Moreover, the lack of visibility and recognition for women in FinTech perpetuates the gender gap,” said the KYND COO. “Combatting this requires elevating the profiles of female professionals through platforms, awards, and media representation. By amplifying their voices and celebrating their achievements, we can inspire future generations of women to pursue careers in cyber.\r\n\r\n“Additionally, work-life balance remains a pressing concern for women in the industry, exacerbated by societal expectations and caregiving responsibilities. Flexible work arrangements, childcare support, and fostering a culture of inclusivity are essential in creating an environment where women can thrive professionally without sacrificing personal well-being.”\r\n\r\nIn KYND’s space of cybersecurity, one of the most common perceptions of the industry is that it is male-orientated – something that can deter girls from pursuing tech from an early age. In the view of Hayes, this perception needs to be addressed at the school level through targeted initiatives that promote it as a viable and welcoming career option for all genders.\r\n\r\n“Indeed, the industry offers a wealth of opportunities beyond traditional software engineering roles, yet this diversity is often overlooked. To attract more women to the industry, it’s imperative to showcase the multifaceted nature of the sector that is not just geared towards men. Highlighting the industry’s exciting prospects, its potential for creativity and problem-solving, and its role in driving positive change can broaden girls’ perceptions of what a career in cyber entails,” Hayes concluded.\r\n\r\nDiversity drives innovation \r\n\r\nThe percentage of women in the FinTech space still remains relatively low when considering the parity between men and women. According to the EY European Financial Services Boardroom Monitor, women hold 39% of financial services board director positions – but this stands at just 11% across FinTechs.\r\n\r\nStacey Jahpta, head of growth at Sybrin, underlined that while representation is low, a report by IMF Digital in 2022 found that fims with a higher share of women executives tend to earn higher revenue and receive more funding – underscoring the economic benefits of gender diversity in leadership positions.\r\n\r\n“Diversity drives innovation and it’s the clash of differing viewpoints that sparks the kind of groundbreaking ideas capable of changing the world. Without it, we risk stagnation, recycling the same old concepts without ever truly breaking new ground,” said Japhta.\r\n\r\nShe continued, “To all the women out there feeling defeated – whether that’s being treated differently, having your voice overlooked, or not receiving fair pay – I wish you find a community that reignites your hope for change.\r\n\r\n“Initiatives like Martha Mghendi-Fisher’s European Women Payments Network (EWPN) and African Women in Fintech & Payments (AWFP) are great examples of these types of groups. Her initiatives aim to champion diversity, not just in terms of gender but also in bringing together individuals from various cultural and professional backgrounds. It’s an encouraging group of women that support each other and share advice, and that’s something we all deserve. It’s time to widen the circle, to invite more voices to the table, and truly listen,” Japhta emphasised.\r\n\r\nChampioning diversity \r\n\r\nAnnalisa Camarillo – chief marketing officer of Quantifind – explained that in the ever-evolving world of FinTech, women are charting bold paths forward – however, they face hurdles that demand our collective attention.\r\n\r\nShe said, “Despite strides towards gender balance, the journey to equality remains challenging. Some of the biggest challenges for women in FinTech include gender bias and stereotypes, limited access to funding and investment opportunities, underrepresentation in leadership roles, and a lack of supportive networks and mentorship.\r\n\r\n“These challenges can be addressed by promoting diversity and inclusion initiatives,\r\nimplementing transparent hiring and promotion practices, providing access to funding and resources specifically tailored to women entrepreneurs, offering mentorship programs, and fostering a supportive work culture that values gender equality and work-life balance.”\r\n\r\nCamarillo gave examples of women who are breaking the mold in FinTech and driving positive change in the industry. One such example was Anne Boden, the founder and CEO of Starling Bank, who the Quantifind CMO cited as being instrumental in revolutionizing the banking sector with innovative digital banking solutions.\r\n\r\nAnother example given was Adena Friedman, the president and CEO of Nasdaq, who Camarillo stated has played a pivotal role in advancing tech-driven solutions and promoting diversity within the financial services industry.\r\n\r\n“These trailblazing women serve as role models and advocates for gender equality, challenging the current paradigm and paving the way for more opportunities and representation for women in FinTech. Their leadership and accomplishments highlight\r\nthe transformative impact that empowered women can have on reshaping\r\nthe landscape of the FinTech sector,” Camarillo said. \r\n\r\nShe added, “At Quantifind, equality, mentorship, and supportive work culture are\r\ninherent in the company values. We lead internal and external women in risk collectives to provide a safe, growth-focused forum for women. More organizations have to walk the talk to see a significant change in the FinTech space. Together, let’s celebrate the pioneers and\r\ncommit to creating a future where every woman has the opportunity to thrive and leave an indelible mark on the industry.”\r\n\r\nStill some way to go\r\n\r\nZaliia Gindullina, head of business development at WealthTech company Kidbrooke, empahsised her belief that the FinTech industry has not done enough to overcome the challenges for women in the sector.\r\n\r\nShe commented, “Many diversity and inclusion programmes in the financial industry still have a predominantly marketing angle – many awards do not highlight the successful policies the industry implements but are given for untransparent reasons. The childcare penalty remains unaddressed, and women dominate the speaker slots only in female-specific events that men do not attend.\r\n\r\n“I believe the industry should stop exploiting the diversity agenda for marketing reasons and try to address the issues head-on.”\r\n\r\nTo deal with these disparities, Gindullina suggests three key pathways to greater equality. First, she suggests helping young mothers return to work after childbirth and create an encouraging environment for fathers to take their parental leaves.\r\n\r\nSecondly, Gindullina calls for organisations to develop events where men get to listen to female experts speaking. “That would require encouraging women to share their expertise and not labelling the events as “female-specific” so half of the audience doesn’t come,” she said.\r\n\r\nFollowing on from this, firms should talk about the policies that work. “It is a notorious myth that diversity and inclusion simply require shoving different people into one room to work.\r\n\r\n“It is a challenging endeavour and one needs to appreciate it – it involves discussion of various, sometimes conflicting viewpoints on the matters, it implies a departure from comfortable ways the organisation has operated before and consideration of matters that weren’t necessarily considered important previously. Diversity works when nobody feels like an outsider – and there is still a long way to go for women not to feel that way in Fintech,” said Gindullina.\r\n\r\nCognitive diversity \r\n\r\nLinda Middleditch – chief product officer at Regnology – offered her view that most companies have a proactive approach to ensure diversity in gender or ethnicity in their hiring and promotions process. To ensure this is possible, Middleditch said there also needs to be a focus on ensuring all groups are represented to ensure a wide candidate pool at every level.\r\n\r\nMiddleditch highlighted she was a ‘passionate advocate’ for STEM initiatives introducing coding to girls early on in school, and supported in other ways educationally for careers in tech.\r\n\r\nIn addition, the Regnology CPO said she would like to see more return-to-work schemes that encourage women to take a break to raise children to return so that invaluable experience and unique skill sets are not lost.\r\n\r\nShe explained, “I have often pointed out that negotiating with a toddler to get him to put his socks and shoes on to go out is incredibly tough. Patience and negotiation are transferable skills. I have often found it very useful when dealing with high-pressure, difficult scenarios on the trading floor, especially when dealing with traders who have been known to throw a tantrum or two.”\r\n\r\nMiddleditch asked though, however, does this really result in a diversity of thinking of just a diversity of looks?\r\n\r\n“Cognitive diversity moves away from the traditional diversity movement and focuses more on a diversity of thinking, in my opinion, this is where you get the most success. Cognitive diversity strengthens our ability to deliver pioneering solutions that address the challenges our clients face today.\r\n\r\n“My background in both financial services and technology has helped me think about the importance of cognitive diversity in other ways, too.\r\n\r\n“I see cognitive diversity – as well as other forms of diversity – as an important quality that enables us to create and innovate, which ultimately benefits our clients. When you have a team of people who are thinking differently, you get better results because they’re coming at it from different angles. My job as a leader is to make sure everybody sees the value in what everyone else is doing – this is incredibly rewarding if you get it right,” said Middleditch.\r\n\r\nOngoing challenges \r\n\r\nIn the opinion of Maygan Voros, senior product manager at ACA, FinTech is one of the most challenging industries for the female population. “It combines the two most heavily male-dominated industries into one unique market, and because of that, it inherently brings in biases when hiring new employees, promoting individuals and investing in ideas.\r\n\r\nVoros noted that this bias can be unintentional, however individuals tend to hire employees that they can connect with or relate to, and it makes it hard for females to make space for themselves when many of the leadership and applicants are male. In addition, women still make up a minority in all STEM-based jobs – 30% of the FinTech industry involves women but only over 10% of the leadership. “Adding in the pay gap that still exists between men and women the Fintech world is not the most appealing for women to enter,” she said.\r\n\r\nHow can such an issue be fixed? “This can be changed through firms putting a greater focus on hiring females. Promoting environments that are inclusive of benefits and lifestyles that women favour. If more women are in leadership roles it can help encourage the next generation to bridge the gap in traditionally male-based industries,”.\r\n\r\nVoros concluded by stating that if FinTechs can invest in helping leadership recognise their biases in a way that doesn’t make them forced to hire females but encourages the idea that a diverse workforce can help boost thework environment and business decision making process, this can go a long way in starting to shift the gender imbalance in the sector.', 'FinTech Global', '2024-12-01'),
(5, 'Bridging the gender diversity gap: Insights from women leaders and founders in European fintech', 'To dig deeper into the current status quo of diversity in the fintech industry and how we can spark change, we spoke with some of the most talented and impactful female founders and senior leaders in European fintech.', 'Journeys into the fintech industry\r\n\r\nThe paths to fintech leadership for female leaders are diverse. They range from working in corporate finance roles and being early employees at fintech startups to venturing in from completely different industries.\r\n\r\nVivi Friedgut, Founder of Blackbullion, transitioned into fintech after spending almost a decade in wealth management. Similarly, Ayesha Ofroi, Founder of Propelle, began her career in finance at Morgan Stanley, then moved to private wealth management at Goldman Sachs, and eventually set out to help women build more wealth with Propelle. After serving as a consultant to banks, Morgan O’hana, Founder of Defacto, was drawn to the problem-solving potential of fintech. Triin Herman, Founder of Grünfin, started her career in finance and transitioned into tech; she was an early employee at Skype where she met Taavet Hinrikus. Taavet later founded Transferwise (now Wise), where Triin joined the early team. Nina Mohanty, CEO and Founder of Bloom Money shares that her journey into fintech was “completely accidental.” Her career in fintech began at Mastercard; she openly shares that “it was the only job she could find at the time.” Before founding Bloom Money, she worked at Starling Bank, helping to launch the current account, championed Open Banking at Bud, and worked on buy now, pay later (BNPL) at Klarna.\r\n\r\nEle Ward, CMO at Ctrl Alt, was part of the UK founding team for sustainability solutions provider Cogo, where she was exposed to fintech as the business adopted Open Banking early on. This sparked Ele’s interest in fintech’s transformative abilities. Anna-Sophie Hartvigsen, Founder of Female Invest, began her journey with a personal desire to empower women investors. Female Invest started as a passion project while they were in business school with no network or experience, which eventually grew into Female Invest, serving 400,000 women through their courses.\r\n\r\nWhile all their backgrounds differ, a common thread emerges a desire to innovate and improve the financial landscape, which brought them all to fintech.\r\nMotivations to work in fintech\r\n\r\nEach leader brings a unique perspective on what motivates them to pursue a career in fintech. Vivi is inspired by the potential of technology to create a more inclusive financial future, stating: “We are still yet to see the full power of technology in making financial services more inclusive.” Ele and Anna are driven by the desire to disrupt the status quo. Ele’s focus at Ctrl Alt is on tokenizing alternative assets, and Anna is on a mission to close the financial gender gap with Female Invest. Nina and Morgan are motivated by the challenge of driving innovation within a vast and complex industry that impacts everyday life. Nina explains: “Money makes the world go around and touches every aspect of life. There is such a humongous opportunity and responsibility for those of us working in this industry to build innovative, thoughtful, impactful products and services.” Triin channels her passion into promoting sustainable investing at Grüfin, aiming to make a difference by aligning her customers’ financial success with environmental well-being. Despite their diverse backgrounds, these women share a common goal: to make a positive impact through innovation and problem-solving in the ever-evolving world of fintech.\r\nImpact of lack of diversity in fintech\r\n\r\nThe experiences with a lack of diversity in fintech varied. While several leaders haven’t encountered direct bias or negative effects of being a woman in the fintech industry, they all acknowledge its broader impact and significantly more work needs to be done to improve equality.\r\n\r\nHaving a lack of diversity in the fintech industry exacerbates unconscious bias problems. Ele highlights that entering the fintech industry can be intimidating, combined with a lack of diversity can be perceived as unwelcoming, she urges that this needs to change. Nina is frustrated that: “people often dismiss diversity as – woke nonsense -, but diversity actually makes for better products.”\r\n\r\nThe women we spoke with shared a sentiment that a lack of diversity hinders the fintech industry’s potential as there are gender differences in customer behaviours in the use of fintech products, and the teams building products should be representative of the customers. Ele highlights that there is a lack of gender-specific data in fintech to inform how products are built. Ayesha finds herself “repeatedly justifying why Propelle exists.” Triin is proud that half of Grünfin’s customers are women and has observed that women might need more assurance and information before switching to a new financial institution. Vivi believes “it is near impossible to service your diverse clientele if you are unable to understand what they need and how they want it.” The views shared underline the importance of diverse perspectives in creating inclusive financial services.\r\n\r\nStarting and operating a fintech is generally capital intensive as it’s highly regulated. Challenges around the lack of funding going to underrepresented founders were continuously raised, including the lack of investor diversity and challenges in fundraising that consequently impact the company’s growth. Ayesha shares that she has had to “explain [her] personal childcare situation to potential investors (usually male) to show them that [she] can be a competent, focused startup founder and a mother at the same time.” Vivi shared that some of her worst investor experiences have “in fact been with female investors so while representation is of course important I do not believe it to be a panacea.”\r\n\r\nAnna sheds light that “women aren’t underfunded because they are bad at building companies (in fact research shows the opposite to be true as money invested in female-founded/led companies give a higher return).” Nina and Ayesha both challenge VCs who speak about supporting diverse founders to take action. Ayesha raises that “sadly many only do it for the PR.” Nina urges VCs to “just do it” and “prove to us that you are doing it” with metrics that they should know inside out, in a similar manner founders are expected to know about the metrics of their startups.\r\nHow can we change the status quo?\r\n\r\nThe female leaders we spoke to shared a range of suggestions on achieving equal opportunity and representation in fintech – from nurturing young talent to bringing men into the conversation.\r\n\r\nFostering work environments and cultures that support diversity:\r\n\r\nMorgan shared a few initiatives that have worked at Defacto including having exclusive interview periods for women and aiming for team balance before reopening the pipeline to all talents. At Defacto, they also have a transparent salary grid which ensures fairness, preventing gender-based pay disparities. In their day-to-day, they have implemented flexible remote work and a culture that supports autonomy catering especially well to women, and addressing the unique challenges they may face, including those balancing motherhood. Defacto has achieved nearly a 50% gender balance across all teams, with the exception of their engineering team, where women constitute about 30%. Ayesha advises job candidates to look for employers who prioritise diversity and inclusion initiatives. She suggests to search a prospective company on LinkedIn and seeing what their team looks like, and also to not be afraid to questions about diversity initiatives and long-term plans because “a good company knows that different perspectives and experiences can ultimately help the company succeed much further than others.”\r\n\r\nCreating more role models and spokespersons inspires underrepresented individuals who look like them in leadership positions:\r\n\r\nEle shares that the rise of platforms like The Heard by Chantal Wilson, a directory of female speakers in fintech, is a practical way to get more women into panels and speaking slots. Ayesha praises the Google for Startups Black Founder Fund that Propelle was part of and made a difference in her journey with Propelle.\r\n\r\nIncreasing transparency and allyship:\r\n\r\nNina underscores that the responsibility for improving diversity shouldn’t solely fall on underrepresented groups, and often don’t have the power to create the change. She urges that everyone should be involved in the dialogue for improving diversity: “If we are going to events talking about diversity, and inclusion, everyone should reach out and bring a male friend to the conversation. this also applies to things like pay transparency. If you have a male counterpart willing to tell you how much he is being paid, then those who are being paid less can justify that and get paid equity.”\r\n\r\nSetting the tone for diversity from a young age can define future generations. Vivi wanted to do something super practical for students at Blackbullion. They have acquired a scholarship company and are working with a growing number of organisations to support diverse talent early in their educational journey, including working with Amazon on their Future Engineer bursaries. Ele is a big supporter of Founders4Schools, a charity she’s previously worked with as part of their work experience program.\r\nAdvice for underrepresented individuals trying to break into fintech or accelerate their career in fintech\r\n\r\nThe call to action from the female fintech leaders is clear: network, build relationships, leverage your unique perspective, and continuously learn and adapt to the evolving fintech industry. Find communities of people to inspire you and believe in your potential, find your support system, and find environments that value inclusivity and offer opportunities for growth. Nina highlights that the fintech industry is a “very close industry, especially in Europe.”', 'Amanda Pun', '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_type` enum('workshop','mentoring','networking','conference') DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `event_type`, `max_participants`, `created_by`, `created_at`) VALUES
(1, 'Women\'s Conference', 'A conference about women\'s role in fintech', '2024-12-03 13:03:55', 'FSEGA', 'conference', 200, 1, '2024-11-30 11:05:11'),
(2, 'Introductory Workshop', 'A workshop for all the new members', '2024-12-06 15:00:00', 'FSEGA', 'workshop', 50, 1, '2024-11-30 11:25:14'),
(3, 'First Mentoring Event', 'First Mentoring Event in the history of our organization', '2024-11-28 13:32:22', 'FSEGA', 'mentoring', 20, 1, '2024-11-30 11:33:40'),
(7, 'asd', 'asd', '2024-12-07 16:12:00', 'FSEGA', 'workshop', 1, NULL, '2024-11-30 14:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('confirmed','waiting','cancelled') DEFAULT 'confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `member_id`, `event_id`, `registration_date`, `status`) VALUES
(2, 14, 1, '2024-11-30 12:35:15', 'confirmed'),
(3, 14, 2, '2024-11-30 12:35:31', 'confirmed'),
(5, 1, 2, '2024-11-30 13:08:28', 'confirmed'),
(7, 14, 3, '2024-11-30 13:30:18', 'confirmed'),
(8, 4, 1, '2024-11-30 13:43:50', 'confirmed'),
(9, 4, 3, '2024-11-30 13:44:41', 'confirmed'),
(10, 1, 7, '2024-11-30 14:12:21', 'confirmed'),
(15, 2, 1, '2024-11-30 19:30:06', 'confirmed'),
(17, 1, 1, '2024-12-01 18:50:22', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `session_id`, `feedback`) VALUES
(1, 1, 'This was amazing'),
(2, 1, 'This was amazing');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profession` varchar(100) DEFAULT '-',
  `company` varchar(100) DEFAULT '-',
  `expertise` text DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `pfp` varchar(500) NOT NULL DEFAULT 'resources/default_profile_pic.jpg',
  `status` enum('admin','member','mentor') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL DEFAULT 'parola'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `email`, `profession`, `company`, `expertise`, `linkedin_profile`, `pfp`, `status`, `created_at`, `password`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '-', '-', '', '', 'resources/pfp_674917b8aee725.33131065.jpg', 'admin', '2024-11-28 22:04:01', 'parola'),
(2, 'Ana', 'Pop', 'ana@pop.ro', 'Scriitor', 'x', 'dada', 'https://www.linkedin.com/in/ana_pop', 'resources/default_profile_pic.jpg', 'member', '2024-11-25 22:20:14', 'parola'),
(3, 'Maria', 'Popescu', 'mariapopescu@yahoo.com', 'Contabil', 'a', 'dasd', 'https://www.linkedin.com/in/maria_popescu', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:07:13', 'parola'),
(4, 'Mara', 'Banc', 'marabanc@gmail.com', 'Contabil', 'ad', 'kvcxv', 'https://www.linkedin.com/in/mara_banc', 'resources/default_profile_pic.jpg', 'mentor', '2024-11-26 10:09:06', 'parola'),
(5, 'Oana', 'Cenan', 'cenanoana@yahoo.com', 'Secretar', 'rkpfg', 'gpkdpskf', 'https://www.linkedin.com/in/oana_cenan', 'resources/default_profile_pic.jpg', 'mentor', '2024-11-26 10:09:53', 'parola'),
(6, 'Roxana', 'Toma', 'roxanatoma@gmail.com', 'Programator', 'faed', 'fdsvasd', 'https://www.linkedin.com/in/roxana_toma', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:12:18', 'parola'),
(7, 'Sara', 'Daniel', 'saradaniel@yahoo.com', 'Director', 'faelsk', 'fkldskl', 'https://www.linkedin.com/in/sara_daniel', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:13:03', 'parola'),
(8, 'Flavia', 'Antonescu', 'flaviaantonescu@yahoo.com', 'HR', 'fldak', 'lfkdalk', 'https://www.linkedin.com/in/flavia_antonescu', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:16:04', 'parola'),
(9, 'Mihaela', 'Deac', 'mihaeladeac@gmail.com', 'Developer', 'fae', 'fasf', 'https://www.linkedin.com/in/mihaela_deac', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:10:17', 'parola'),
(10, 'Denisa', 'Andreica', 'denisaandreica@gmail.com', 'HR', 'fsd', 'sfvdsf', 'https://www.linkedin.com/in/denisa_andreica', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:11:18', 'parola'),
(11, 'Andreea', 'Plosca', 'andreeaplosca@gmail.com', 'Contabil', 'gdsg', 'eafas', 'https://www.linkedin.com/in/andreea_plosca', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:12:10', 'parola'),
(12, 'Larisa', 'Bota', 'larisabota@gmail.com', 'Developer', 'kad', 'fljdsjflvcx', 'https://www.linkedin.com/in/larisa_bota', 'resources/default_profile_pic.jpg', 'member', '2024-11-28 23:09:59', 'parola'),
(13, 'Ramona', 'Zaha', 'ramonazaha@yahoo.com', 'Director', 'fgeakd', 'flkdlfkdsq', 'https://www.linkedin.com/in/ramona_zaha', 'resources/pfp_674918c5b59218.60502720.jpg', 'member', '2024-11-28 23:13:16', 'parola'),
(14, 'Briana', 'Ochis', 'bri@gmail.com', '-', '-', NULL, NULL, 'resources/default_profile_pic.jpg', 'member', '2024-11-29 16:04:22', 'parola'),
(15, 'Gigi', 'Lele', 'gigi@lele.com', '-', '-', NULL, NULL, 'resources/default_profile_pic.jpg', 'member', '2024-12-01 13:13:16', 'parola');

-- --------------------------------------------------------

--
-- Table structure for table `mentorship_matches`
--

CREATE TABLE `mentorship_matches` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `progress` enum('beginner','intermediate','advanced','complete') DEFAULT 'beginner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentorship_matches`
--

INSERT INTO `mentorship_matches` (`id`, `mentor_id`, `member_id`, `created_at`, `progress`) VALUES
(5, 4, 2, '2024-12-01 13:23:57', 'beginner'),
(6, 5, 2, '2024-12-01 13:27:28', 'intermediate'),
(7, 4, 15, '2024-12-01 15:29:22', 'beginner');

-- --------------------------------------------------------

--
-- Table structure for table `mentorship_requests`
--

CREATE TABLE `mentorship_requests` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentorship_requests`
--

INSERT INTO `mentorship_requests` (`id`, `member_id`, `mentor_id`, `status`, `created_at`) VALUES
(8, 2, 4, '', '2024-12-01 11:23:49'),
(9, 2, 5, '', '2024-12-01 11:27:03'),
(11, 15, 4, '', '2024-12-01 13:29:08'),
(12, 14, 5, '', '2024-12-01 18:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `mentorship_sessions`
--

CREATE TABLE `mentorship_sessions` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `session_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentorship_sessions`
--

INSERT INTO `mentorship_sessions` (`id`, `mentor_id`, `member_id`, `session_date`, `location`, `notes`, `created_at`) VALUES
(1, 5, 2, '2024-12-02 13:55:00', 'FSEGA', 'asdasd', '2024-12-01 11:55:25'),
(2, 4, 2, '2024-11-15 14:14:00', 'FSEGA', 'asd', '2024-12-01 12:14:36'),
(3, 5, 2, '2024-12-12 14:49:00', 'FSEGA', 'ddd', '2024-12-01 12:50:05'),
(5, 4, 15, '2024-12-11 16:25:00', 'FSEGA', 'asd', '2024-12-01 14:25:50'),
(6, 4, 15, '2024-12-11 16:25:00', 'FSEGA', 'asd', '2024-12-01 14:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `member_id`, `message`, `read_status`, `created_at`, `link`) VALUES
(1, 1, 'Welcome to the Women Fintech website!', 1, '2024-11-29 15:33:21', NULL),
(2, 14, 'Welcome to Women in FinTech, Briana! Your account has been created successfully.', 1, '2024-11-29 16:04:22', NULL),
(3, 1, 'notification', 1, '2024-11-30 10:14:57', NULL),
(4, 15, 'Welcome to Women in FinTech, Gigi! Your account has been created successfully.', 0, '2024-12-01 13:13:16', 'edit_profile.php'),
(5, 4, 'You have a new mentorship request from  ', 1, '2024-12-01 13:26:48', 'view_mentorship_requests.php?mentor_id=4'),
(6, 4, 'You have a new mentorship request!', 1, '2024-12-01 13:29:08', 'mentorship.php'),
(7, 5, 'You have a new mentorship request!', 0, '2024-12-01 18:52:29', 'mentorship.php');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `event_id`, `member_id`, `rating`, `review`, `created_at`) VALUES
(1, 3, 1, 5, 'This was very eye opening', '2024-11-30 12:07:49'),
(2, 3, 2, 4, 'It was a good experience', '2024-11-30 12:08:51'),
(3, 3, 14, 1, 'Not very interesting', '2024-11-30 13:30:18'),
(4, 3, 4, 1, 'Rau', '2024-11-30 13:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `desciere` text NOT NULL,
  `published_at` date NOT NULL DEFAULT current_timestamp(),
  `tip` enum('podcast','material_video','','') NOT NULL DEFAULT 'material_video',
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `titlu`, `desciere`, `published_at`, `tip`, `link`) VALUES
(1, 'Women in Fintech | Mambu', 'Fintech is no fairy tale, but it is life changing. Carolina Brochado, Founding Partner, EQT Growth and Mambu’s VP of Marketing Laurel Wolfe delve into the latest market trends, investment booms and busts and discuss why diversity will become a reality as the growth of female-focussed fintechs continues.\r\n', '2024-12-01', 'podcast', 'https://www.youtube.com/watch?v=TvjP1ySE4ys'),
(2, 'Women in FinTech- Shamirah Kimbugwe- The Ugandan Podcast', 'In celebration of Women\'s History Month, the Ugandan Podcast is highlighting women who are breaking barriers in the tech industry. Our second guest is Shamirah Kimbugwe, the CEO of Pivot Payments, a female-founded fintech company with over 15 years of experience in the industry.', '2024-12-01', 'podcast', 'https://www.youtube.com/watch?v=9ffaBcpqFHs'),
(3, 'Fintech Explained (From a Fintech Software Engineer)', 'I never really understood what\'s FinTech--there are credit cards, banks, and apps like Venmo, and sure there\'s software that is used by each but that\'s the case with virtually anything else these days. Though, then I started working at a FinTech company, and later on I moved to another one, and it finally made sense. FinTech is the intersection of finance and tech--but you already knew that. So, yes, FinTech companies build software that\'s designed to provide financial services, but what\'s the big deal?', '2024-12-01', 'material_video', 'https://www.youtube.com/watch?v=iJYBH5rm_bE'),
(4, 'Fintech : How it works', 'A quick video to explain how Fintech works for you!', '2024-12-01', 'material_video', 'https://www.youtube.com/watch?v=PuAbqwTDeh0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mentorship_matches`
--
ALTER TABLE `mentorship_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `mentorship_requests`
--
ALTER TABLE `mentorship_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `mentorship_sessions`
--
ALTER TABLE `mentorship_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mentorship_matches`
--
ALTER TABLE `mentorship_matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mentorship_requests`
--
ALTER TABLE `mentorship_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mentorship_sessions`
--
ALTER TABLE `mentorship_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `members` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `mentorship_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mentorship_matches`
--
ALTER TABLE `mentorship_matches`
  ADD CONSTRAINT `mentorship_matches_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `mentorship_matches_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `mentorship_requests`
--
ALTER TABLE `mentorship_requests`
  ADD CONSTRAINT `mentorship_requests_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `mentorship_requests_ibfk_2` FOREIGN KEY (`mentor_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `mentorship_sessions`
--
ALTER TABLE `mentorship_sessions`
  ADD CONSTRAINT `mentorship_sessions_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `mentorship_sessions_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
